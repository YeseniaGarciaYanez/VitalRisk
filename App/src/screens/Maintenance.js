import React, { useState, useEffect } from 'react';
import { 
  View, Text, TextInput, TouchableOpacity, Alert, 
  StyleSheet, ScrollView, KeyboardAvoidingView, Platform 
} from 'react-native';
import { Picker } from '@react-native-picker/picker';
import axios from 'axios';

const Maintenance = () => {
  const [equipment, setEquipment] = useState('');
  const [problem, setProblem] = useState('');
  const [date, setDate] = useState('');
  const [equipmentList, setEquipmentList] = useState([]);

  // Cargar equipos desde la API externa
  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get('https://sheet2api.com/v1/I4xIqLkaSRe4/equiposmedicos');
        console.log('Datos recibidos:', response.data);
        
        if (Array.isArray(response.data) && response.data.length > 0) {
          setEquipmentList(response.data);
        }
      } catch (error) {
        console.error('Error al obtener los datos:', error);
        Alert.alert('Error', 'Failed to fetch equipment data.');
      }
    };

    fetchData();
  }, []);

  // Filtrar equipos (máximo 15)
  const limitedEquipmentList = equipmentList.slice(0, 15);

  // Enviar datos a la API (guardar en la base de datos)
  const handleSubmit = async () => {
    if (!equipment || !problem || !date) {
      Alert.alert('Error', 'Please complete all fields.');
      return;
    }

    try {
      const response = await axios.post('https://tu-servidor.com/guardar_mantenimiento.php', {
        equipo: equipment,
        problema: problem,
        fecha: date
      });

      if (response.data.success) {
        Alert.alert('Success', 'Maintenance request submitted.');
        setEquipment('');
        setProblem('');
        setDate('');
      } else {
        throw new Error(response.data.error || 'Error en la respuesta del servidor');
      }
    } catch (error) {
      console.error('Error al enviar la solicitud:', error);
      Alert.alert('Error', 'Failed to submit maintenance request.');
    }
  };

  return (
    <KeyboardAvoidingView behavior={Platform.OS === 'ios' ? 'padding' : 'height'} style={styles.container}>
      <ScrollView contentContainerStyle={styles.scrollContainer}>
        <Text style={styles.title}>Mantenimiento</Text>
        
        <Text style={styles.label}>Equipment</Text>
        <Picker
          selectedValue={equipment}
          style={styles.input}
          onValueChange={(itemValue) => setEquipment(itemValue)}
        >
          <Picker.Item label="Selecciona un equipo" value="" color="#999" />
          {limitedEquipmentList.length > 0 ? (
            limitedEquipmentList.map((item, index) => (
              <Picker.Item 
                key={index} 
                label={item['Nombre del Equipo']} 
                value={item['Nombre del Equipo']} 
              />
            ))
          ) : (
            <Picker.Item label="No equipment available" value="" />
          )}
        </Picker>
        
        <Text style={styles.label}>Problem</Text>
        <TextInput 
          style={[styles.input, styles.problem]} 
          value={problem} 
          onChangeText={setProblem} 
          placeholder="Describe the issue"
          placeholderTextColor="#999"
          multiline
        />
        
        <Text style={styles.label}>Appointment Date</Text>
        <TextInput 
          style={styles.input} 
          value={date} 
          onChangeText={setDate} 
          placeholder="YYYY-MM-DD"
          placeholderTextColor="#999"
        />

        <TouchableOpacity 
          style={styles.button} 
          onPress={handleSubmit}
        >
          <Text style={styles.buttonText}>Send</Text>
        </TouchableOpacity>
      </ScrollView>
    </KeyboardAvoidingView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#FFF',
    width: '85%',
  },
  scrollContainer: {
    padding: 20,
    paddingBottom: 50,
  },
  title: {
    fontSize: 25,
    fontWeight: 'bold',
    color: '#23998E',
    textAlign: 'center',
    marginTop: 60,
    marginBottom: 30,
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
    padding: 12,
    fontSize: 15,
    borderWidth: 1,
    borderColor: '#D1D9E6',
    marginBottom: 15,
    shadowColor: "#000",
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.1,
    shadowRadius: 3,
    elevation: 3,
  },
  problem: {
    height: 90,
    textAlignVertical: 'top',
  },
  button: {
    backgroundColor: '#2980B9',
    paddingVertical: 14,
    borderRadius: 10,
    alignItems: 'center',
    justifyContent: 'center',
    shadowColor: "#000",
    shadowOffset: { width: 0, height: 3 },
    shadowOpacity: 0.2,
    shadowRadius: 4,
    elevation: 4,
  },
  buttonText: {
    fontSize: 16,
    color: '#FFF',
    fontWeight: 'bold',
  },
});

export default Maintenance;
