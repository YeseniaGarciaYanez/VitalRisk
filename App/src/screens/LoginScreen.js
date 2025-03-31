import React, { useState, useEffect } from 'react';
import { View, Text, TextInput, TouchableOpacity, Alert, StyleSheet } from 'react-native';
import { Picker } from '@react-native-picker/picker';
import axios from 'axios';

const LoginScreen = () => {
  const [clues, setClues] = useState('');
  const [password, setPassword] = useState('');
  const [hospitalList, setHospitalList] = useState([]);

  // Cargar hospitales desde la API
  useEffect(() => {
    const fetchHospitals = async () => {
      try {
        const response = await axios.get('https://sheet2api.com/v1/OOb2tXvPROOB/ola');
        setHospitalList(response.data);
      } catch (error) {
        console.error('Error al obtener hospitales:', error);
        Alert.alert('Error', 'No se pudo cargar la lista de hospitales.');
      }
    };

    fetchHospitals();
  }, []);

  // Enviar datos al servidor para autenticación
  const handleLogin = async () => {
    if (!clues || !password) {
      Alert.alert('Error', 'Ingresa CLUES y contraseña.');
      return;
    }

    try {
      const response = await axios.post('https://tu-servidor.com/login.php', { clues, password });
      if (response.data.success) {
        Alert.alert('Éxito', 'Inicio de sesión correcto');
      } else {
        Alert.alert('Error', response.data.error);
      }
    } catch (error) {
      console.error('Error en login:', error);
      Alert.alert('Error', 'No se pudo iniciar sesión.');
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Login Hospital</Text>

      <Text style={styles.label}>Selecciona tu hospital</Text>
      <Picker selectedValue={clues} style={styles.input} onValueChange={(value) => setClues(value)}>
        <Picker.Item label="Selecciona un hospital" value="" />
        {hospitalList.map((hospital, index) => (
          <Picker.Item key={index} label={hospital.Nombre} value={hospital.CLUES} />
        ))}
      </Picker>

      <Text style={styles.label}>Contraseña</Text>
      <TextInput
        style={styles.input}
        value={password}
        onChangeText={setPassword}
        placeholder="Ingresa tu contraseña"
        secureTextEntry
      />

      <TouchableOpacity style={styles.button} onPress={handleLogin}>
        <Text style={styles.buttonText}>Iniciar Sesión</Text>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: 'center', padding: 20, backgroundColor: '#FFF' },
  title: { fontSize: 24, fontWeight: 'bold', textAlign: 'center', marginBottom: 20 },
  label: { fontSize: 16, fontWeight: '600', marginBottom: 5 },
  input: { backgroundColor: '#FFF', borderRadius: 10, padding: 12, fontSize: 15, borderWidth: 1, borderColor: '#D1D9E6', marginBottom: 15 },
  button: { backgroundColor: '#2980B9', paddingVertical: 14, borderRadius: 10, alignItems: 'center' },
  buttonText: { fontSize: 16, color: '#FFF', fontWeight: 'bold' },
});

export default LoginScreen;
