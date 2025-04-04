import React, { useState, useEffect } from 'react';
import { 
  View, Text, TextInput, TouchableOpacity, Alert, 
  StyleSheet, ScrollView, KeyboardAvoidingView, Platform 
} from 'react-native';
import { Picker } from '@react-native-picker/picker';
import axios from 'axios';
import AsyncStorage from '@react-native-async-storage/async-storage';  // Importamos AsyncStorage

// Importación condicional de DateTimePicker
let DateTimePicker;
if (Platform.OS !== 'web') {
  DateTimePicker = require('@react-native-community/datetimepicker').default;
}

const Maintenance = () => {
  const [selectedView, setSelectedView] = useState('agendar'); // Alterna entre vistas
  const [equipment, setEquipment] = useState('');
  const [problem, setProblem] = useState('');
  const [date, setDate] = useState(new Date());
  const [equipmentList, setEquipmentList] = useState([]);
  const [showDatePicker, setShowDatePicker] = useState(false);
  const [dateMode, setDateMode] = useState("date");
  const [clues, setClues] = useState('');  // Variable para guardar el CLUES

  const formattedDate = new Intl.DateTimeFormat('es-ES', {
    day: '2-digit',
    month: '2-digit',
    year: '2-digit'
  }).format(date);

  // Cargar lista de equipos desde la API
  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get('https://sheet2api.com/v1/I4xIqLkaSRe4/equiposmedicos');
        if (Array.isArray(response.data) && response.data.length > 0) {
          setEquipmentList(response.data);
        }
      } catch (error) {
        console.error('Error al obtener los datos:', error);
        Alert.alert('Error', 'No se pudo obtener la lista de equipos.');
      }
    };
    fetchData();

    // Recuperar el CLUES del AsyncStorage
    const fetchClues = async () => {
      try {
        const storedClues = await AsyncStorage.getItem('clues');
        if (storedClues) {
          setClues(storedClues);  // Guardamos el CLUES recuperado
        }
      } catch (error) {
        console.error('Error al recuperar el CLUES:', error);
      }
    };
    fetchClues();
  }, []);

  const handleSubmit = async () => {
    if (!equipment || !problem || !date || !clues) {
      Alert.alert('Error', 'Por favor, completa todos los campos.');
      return;
    }

    try {
      // Enviar datos al servidor (incluyendo el CLUES)
      const response = await axios.post('http://192.168.100.8/VitalRisk/App/src/apis/mantenimiento.php', {
        clues,
        equipment,
        problem,
        date: formattedDate,
      });

      if (response.data.success) {
        Alert.alert('Éxito', 'Solicitud de mantenimiento enviada.');
        setEquipment('');
        setProblem('');
        setDate(new Date());
      } else {
        Alert.alert('Error', response.data.message || 'No se pudo enviar la solicitud de mantenimiento.');
      }
    } catch (error) {
      console.error('Error al enviar la solicitud:', error);
      Alert.alert('Error', 'No se pudo enviar la solicitud de mantenimiento.');
    }
  };

  const onChangeDate = (event, selectedDate) => {
    const currentDate = selectedDate || date;
    setShowDatePicker(Platform.OS === 'ios');
    setDate(currentDate);
  };

  return (
    <KeyboardAvoidingView behavior={Platform.OS === 'ios' ? 'padding' : 'height'} style={styles.container}>
      <ScrollView contentContainerStyle={styles.scrollContainer}>
        
        {/* Botones para alternar vistas */}
        <View style={styles.toggleContainer}>
          <TouchableOpacity 
            style={[styles.toggleButton, selectedView === 'agendar' && styles.selectedButton]}
            onPress={() => setSelectedView('agendar')}
          >
            <Text style={styles.toggleText}>Agendar Mantenimiento</Text>
          </TouchableOpacity>
          <TouchableOpacity 
            style={[styles.toggleButton, selectedView === 'ver' && styles.selectedButton]}
            onPress={() => setSelectedView('ver')}
          >
            <Text style={styles.toggleText}>Ver Mantenimientos</Text>
          </TouchableOpacity>
        </View>

        {selectedView === 'agendar' ? (
          <View>
            <Text style={styles.title}>Agendar Mantenimiento</Text>

            <Text style={styles.label}>Equipo</Text>
            <Picker
              selectedValue={equipment}
              style={styles.input}
              onValueChange={(itemValue) => setEquipment(itemValue)}
            >
              <Picker.Item label="Selecciona un equipo" value="" color="#999" />
              {equipmentList.slice(0, 15).map((item, index) => (
                <Picker.Item 
                  key={index} 
                  label={item['Nombre del Equipo']} 
                  value={item['Nombre del Equipo']} 
                />
              ))}
            </Picker>

            <Text style={styles.label}>Problema</Text>
            <TextInput 
              style={[styles.input, styles.problem]} 
              value={problem} 
              onChangeText={setProblem} 
              placeholder="Describe el problema"
              placeholderTextColor="#999"
              multiline
            />

            <View style={styles.dateTimeContainer}>
              <Text style={styles.dateTimeText}>Fecha:</Text>
              <TouchableOpacity style={styles.datePickerButton} onPress={() => setShowDatePicker(true)}>
                <Text style={styles.datePickerText}>{formattedDate}</Text>
              </TouchableOpacity>
              {showDatePicker && (
                <DateTimePicker
                  testID="datePicker"
                  value={date}
                  mode={dateMode}
                  display={Platform.OS === 'android' ? 'calendar' : 'default'}
                  onChange={onChangeDate}
                  minimumDate={new Date()} // Bloquea fechas anteriores a hoy
                />
              )}
            </View>

            <TouchableOpacity style={styles.button} onPress={handleSubmit}>
              <Text style={styles.buttonText}>Enviar</Text>
            </TouchableOpacity>
          </View>
        ) : (
          <View>
            <Text style={styles.title}>Mantenimientos Agendados</Text>
            <Text style={{ textAlign: 'center', marginTop: 20 }}>Aquí se mostrarán los mantenimientos agendados.</Text>
          </View>
        )}

      </ScrollView>
    </KeyboardAvoidingView>
  );
};

const styles = StyleSheet.create({
  container: {
    backgroundColor: '#FFFFFF',
    padding: 20,
  },
  scrollContainer: {
    paddingBottom: 20,
  },
  toggleContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 15,
  },
  toggleButton: {
    flex: 1,
    paddingVertical: 10,
    backgroundColor: '#E0E0E0',
    alignItems: 'center',
    borderRadius: 10,
    marginHorizontal: 5,
  },
  selectedButton: {
    backgroundColor: '#23998E',
  },
  toggleText: {
    fontSize: 14,
    fontWeight: 'bold',
    color: '#FFFFFF',
  },
  title: {
    fontSize: 22,
    fontWeight: 'bold',
    color: '#23998E',
    textAlign: 'center',
    marginBottom: 20,
  },
  label: {
    fontSize: 16,
    fontWeight: '600',
    color: '#34495E',
    marginBottom: 5,
  },
  input: {
    backgroundColor: '#FFF',
    borderRadius: 10,
    padding: 10,
    fontSize: 15,
    borderWidth: 1,
    borderColor: '#D1D9E6',
    marginBottom: 15,
  },
  problem: {
    height: 90,
    textAlignVertical: 'top',
  },
  button: {
    backgroundColor: '#23998E',
    paddingVertical: 14,
    borderRadius: 10,
    alignItems: 'center',
  },
  buttonText: {
    fontSize: 16,
    color: '#FFF',
    fontWeight: 'bold',
  },
  dateTimeContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 10,
  },
  datePickerButton: {
    width: 150,
    padding: 10,
    backgroundColor: '#f9f9f9',
    borderRadius: 6,
    alignItems: 'center',
    justifyContent: 'center',
  },
  datePickerText: {
    fontSize: 14,
  },
});

export default Maintenance;
