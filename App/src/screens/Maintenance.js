import React, { useState } from 'react';
import { View, Text, TextInput, Button, Alert, StyleSheet } from 'react-native';

const Maintenance = () => {
  const [equipment, setEquipment] = useState('');
  const [problem, setProblem] = useState('');
  const [date, setDate] = useState('');

  const handleSubmit = () => {
    if (!equipment || !problem || !date) {
      Alert.alert('Error', 'No data found');
      return;
    }
    Alert.alert('Form submitted');
  };

  return (
    <View style={styles.container}>
      <Text style={styles.label}>Equipment:</Text>
      <TextInput style={styles.input} value={equipment} onChangeText={setEquipment} placeholder="" />
      
      <Text style={styles.label}>Problem:</Text>
      <TextInput style={[styles.input, styles.problem]} value={problem} onChangeText={setProblem} placeholder="" />
      
      <Text style={styles.label}>Appointment date:</Text>
      <TextInput style={styles.input} value={date} onChangeText={setDate} placeholder="" />

      
      
      <Button title="Send" onPress={handleSubmit} color="#23998E"/>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    padding: 20,
  },
  label: {
    fontSize: 16,
    fontWeight: 'bold',
    marginTop: 10,
  },
  input: {
    borderWidth: 1,
    borderColor: '#ccc',
    padding: 10,
    marginVertical: 5,
    borderRadius: 5,
    marginBottom: 25,
  },
  problem: {
    padding: 50,
  },

  
});

export default Maintenance;
