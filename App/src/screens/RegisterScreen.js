import React, { useState } from 'react';
import { 
  View, Text, TextInput, TouchableOpacity, Alert, 
  StyleSheet 
} from 'react-native';
import axios from 'axios';

const RegisterScreen = ({ navigation }) => {
  const [clues, setClues] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');

  const handleRegister = async () => {
    if (!clues || !password || !confirmPassword) {
      Alert.alert('Error', 'Por favor, ingresa CLUES, contraseña y confirma la contraseña.');
      return;
    }

    if (password !== confirmPassword) {
      Alert.alert('Error', 'Las contraseñas no coinciden.');
      return;
    }

    try {
      const response = await axios.post('http://localhost/VitalRisk/Web/pages/cliente/register.php', {
        clues,
        password,
      });

      console.log('Respuesta del servidor:', response.data);

      if (response.data.success) {
        Alert.alert('Éxito', 'Registro exitoso');
        // Navegar a la pantalla de login después del registro
        navigation.navigate('Login');
      } else {
        Alert.alert('Error', response.data.message || 'No se pudo registrar.');
      }
    } catch (error) {
      console.error('Error al registrar:', error);
      Alert.alert('Error', 'No se pudo conectar con el servidor.');
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Registrarse</Text>
      
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
      
      <TextInput 
        style={styles.input}
        placeholder="Confirmar contraseña"
        secureTextEntry
        value={confirmPassword}
        onChangeText={setConfirmPassword}
      />
      
      <TouchableOpacity style={styles.button} onPress={handleRegister}>
        <Text style={styles.buttonText}>Registrarse</Text>
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
});

export default RegisterScreen;
