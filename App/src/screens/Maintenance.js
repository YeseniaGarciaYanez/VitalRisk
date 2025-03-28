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

  // Cargar equipos desde la API
  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get('https://sheet2api.com/v1/I4xIqLkaSRe4/equiposmedicos');
        setEquipmentList(response.data);  // Guardamos la lista de equipos
        if (response.data.length > 0) {
          setEquipment(response.data[0]['Nombre del Equipo']); // Asignamos el primer equipo por defecto
        }
      } catch (error) {
        console.error(error);
        Alert.alert('Error', 'Failed to fetch equipment data.');
      }
    };

    fetchData();
  }, []);

  // Limitar y filtrar equipos (en este caso, los primeros 5 que contienen la palabra 'medico')
  const limitedEquipmentList = equipmentList
    //.filter(item => item['Nombre del Equipo'].toLowerCase().includes('Bomba '))  // Filtramos
    .slice(0, 15);  // Limitar a los primeros 5

  const handleSubmit = () => {
    if (!equipment || !problem || !date) {
      Alert.alert('Error', 'Please complete all fields.');
      return;
    }
    Alert.alert('Success', 'Maintenance request submitted.');
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
          {limitedEquipmentList.length > 0 ? (
            limitedEquipmentList.map((item, index) => (
              
              <Picker.Item 
                key={index} 
                label=''
              />
            ))
          ) : (
            <Picker.Item label="" value="" />
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
          style={({ pressed }) => [styles.button, pressed && styles.buttonPress]} 
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
    color: '#23998E',
    fontWeight: 'bold',
  },
  buttonPress: {
    opacity: 0.8,
  },
});

export default Maintenance;
