import React, { useState } from 'react';
import { View, Text, TextInput, Button, Alert, StyleSheet } from 'react-native';

const Maintenance = () => {
  const [nombre, setNombre] = useState('');
  const [email, setEmail] = useState('');
  const [telefono, setTelefono] = useState('');

  const handleSubmit = () => {
    if (!nombre || !email || !telefono) {
      Alert.alert('Error', 'Todos los campos son obligatorios');
      return;
    }
    Alert.alert('Formulario enviado', `Nombre: ${nombre}\nEmail: ${email}\nTeléfono: ${telefono}`);
  };

  return (
    <View style={styles.container}>
      <Text style={styles.label}>Equipment:</Text>
      <TextInput style={styles.input} value={nombre} onChangeText={setNombre} placeholder="Ingrese su nombre" />
      
      <Text style={styles.label}>Problem:</Text>
      <TextInput style={styles.input} value={email} onChangeText={setEmail} placeholder="Ingrese su email" keyboardType="email-address" />
      
      <Text style={styles.label}>Appointment date:</Text>
      <TextInput style={styles.input} value={telefono} onChangeText={setTelefono} placeholder="" keyboardType="phone-pad" />
      
      <Button title="Send" onPress={handleSubmit} />
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
  },
});

export default Maintenance;
