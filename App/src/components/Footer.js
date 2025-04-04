import React from 'react';
import { View, Text, TouchableOpacity, StyleSheet } from 'react-native';
import { useNavigation } from '@react-navigation/native';
import MaterialIcons from 'react-native-vector-icons/MaterialIcons';
import FontAwesome from 'react-native-vector-icons/FontAwesome';

const Footer = () => {
  const navigation = useNavigation(); // Permite navegar entre pantallas

  const handleLogout = () => {
    // Aquí podrías implementar el proceso de logout, por ejemplo:
    // Eliminar el token o los datos de sesión almacenados
    // y luego navegar a la pantalla de login.
    console.log('Logout');
    navigation.navigate('Login'); // Redirige a la pantalla de Login
  };

  return (
    <View style={styles.footer}>
      <View style={styles.footerRow}>
        <TouchableOpacity style={styles.footerButton} onPress={() => navigation.navigate('HomeScreen')}>
          <MaterialIcons name="home" size={25} color="#7CBC9A" />
          <Text style={styles.footerText}>HOME</Text>
        </TouchableOpacity>

        <TouchableOpacity style={styles.footerButton} onPress={() => navigation.navigate('Maintenance')}>
          <FontAwesome name="wrench" size={25} color="#7CBC9A" />
          <Text style={styles.footerText}>MAINTENANCE</Text>
        </TouchableOpacity>

        <TouchableOpacity style={styles.footerButton} onPress={() => navigation.navigate('Profile')}>
          <FontAwesome name="user" size={25} color="#7CBC9A" />
          <Text style={styles.footerText}>PROFILE</Text>
        </TouchableOpacity>

        {/* Botón de Logout */}
        <TouchableOpacity style={styles.footerButton} onPress={handleLogout}>
          <MaterialIcons name="exit-to-app" size={25} color="#7CBC9A" />
          <Text style={styles.footerText}>LOGOUT</Text>
        </TouchableOpacity>
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  footer: {
    position: 'absolute',
    bottom: 0,
    left: 0,
    right: 0,
    backgroundColor: '#23998E',
    alignItems: 'center',
  },
  footerRow: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    width: '100%',
  },
  footerButton: {
    paddingHorizontal: 20,
    paddingVertical: 10,
    justifyContent: 'center',
    alignItems: 'center',
  },
  footerText: {
    color: '#fff',
    fontSize: 10,
    fontWeight: 'bold',
  },
});

export default Footer;
