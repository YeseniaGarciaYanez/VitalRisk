import React, { useState } from 'react';
import { 
  View, Text, TextInput, TouchableOpacity, Alert, 
  StyleSheet, Image 
} from 'react-native';
import axios from 'axios';
import AsyncStorage from '@react-native-async-storage/async-storage';  // Importamos AsyncStorage

const LoginScreen = ({ navigation }) => {
  const [clues, setClues] = useState('');
  const [password, setPassword] = useState('');
  const logo = require('../../Logo/logovital.png') 

  const handleLogin = async () => {
    if (!clues || !password) {
      Alert.alert('Error', 'Por favor, ingresa CLUES y contraseña.');
      return;
    }

    try {
      const response = await axios.post('http://192.168.0.101/VitalRisk/App/src/apis/login.php', {
        clues,
        password,
      });

      console.log('Respuesta del servidor:', response.data);

      if (response.data.success) {
        // Guardamos el CLUES en AsyncStorage si el login es exitoso
        await AsyncStorage.setItem('clues', clues);
        
        Alert.alert('Éxito', 'Inicio de sesión exitoso');
        navigation.navigate('HomeScreen');
      } else {
        Alert.alert('Error', response.data.message || 'Credenciales incorrectas.');
      }
    } catch (error) {
      console.error('Error al iniciar sesión:', error);
      Alert.alert('Error', 'No se pudo conectar con el servidor.');
    }
  };

  return (
    <View style={styles.container}>
      <Image style={styles.image} source={logo} />
      
      <TextInput 
        style={styles.input}
        placeholder="Ingrese CLUES"
        value={clues}
        onChangeText={setClues}
      />
      
      <TextInput 
        style={styles.input}
        placeholder="Ingrese contraseña"
        secureTextEntry
        value={password}
        onChangeText={setPassword}
      />
      
      <TouchableOpacity style={styles.button} onPress={handleLogin}>
        <Text style={styles.buttonText}>Iniciar Sesión</Text>
      </TouchableOpacity>

      <TouchableOpacity onPress={() => navigation.navigate('Register')}>
        <Text style={styles.registerText}>
          ¿No tienes una cuenta? <Text style={styles.registerLink}>Regístrate aquí</Text>
        </Text>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
    backgroundColor: '#fff',
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 20,
  },
  image: {
    width: 300,
    height: 150,
    marginBottom: 80,
  },
  input: {
    width: '100%',
    padding: 10,
    marginBottom: 10,
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 5,
  },
  button: {
    backgroundColor: '#23998E',
    padding: 10,
    width: '100%',
    alignItems: 'center',
    borderRadius: 5,
  },
  buttonText: {
    color: '#fff',
    fontSize: 16,
    fontWeight: 'bold',
  },
  registerText: {
    marginTop: 15,
    fontSize: 14,
    color: '#555',
  },
  registerLink: {
    color: '#23998E',
    fontWeight: 'bold',
  },
});

export default LoginScreen;
