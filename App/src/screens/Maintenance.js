import React, { useState } from 'react';
import { View, Text, TextInput, TouchableOpacity, Alert, StyleSheet, ScrollView, KeyboardAvoidingView, Platform } from 'react-native';

const Maintenance = () => {
  const [equipment, setEquipment] = useState('');
  const [problem, setProblem] = useState('');
  const [date, setDate] = useState('');

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
        <Text style={styles.title}>Equipment Maintenance</Text>
        
        <Text style={styles.label}>Equipment</Text>
        <TextInput 
          style={styles.input} 
          value={equipment} 
          onChangeText={setEquipment} 
          placeholder="Enter equipment name"
          placeholderTextColor="#999"
        />
        
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

        <TouchableOpacity style={styles.button} onPress={handleSubmit}>
          <Text style={styles.buttonText}>Send</Text>
        </TouchableOpacity>
      </ScrollView>
    </KeyboardAvoidingView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#F4F6F9',
  },
  scrollContainer: {
    padding: 25,
    paddingBottom: 50,
  },
  title: {
    fontSize: 35,
    fontWeight: 'bold',
    marginTop: 80,
    marginBottom: 35,
    color: '#FA3419',  // **Color original**
    textAlign: 'center',
  },
  label: {
    fontSize: 16,
    fontWeight: 'bold',
    marginTop: 10,
    color: '#1D5E69', // **Color original**
  },
  input: {
    backgroundColor: '#FFF',
    borderRadius: 8,
    padding: 12,
    fontSize: 15,
    borderWidth: 1,
    borderColor: '#ccc',
    marginBottom: 20,
    shadowColor: "#000",
    shadowOffset: { width: 0, height: 1 },
    shadowOpacity: 0.1,
    shadowRadius: 2,
    elevation: 2, // **Para Android**
  },
  problem: {
    height: 80,
    textAlignVertical: 'top',
  },
  button: {
    backgroundColor: '#1D5E69', // **Color original**
    paddingVertical: 12,
    borderRadius: 8,
    alignItems: 'center',
    shadowColor: "#000",
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.2,
    shadowRadius: 3,
    elevation: 3, // **Para Android**
  },
  buttonText: {
    fontSize: 16,
    color: '#FFF',
    fontWeight: 'bold',
  },
});

export default Maintenance;
