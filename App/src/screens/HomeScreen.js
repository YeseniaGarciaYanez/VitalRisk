import React from 'react';
import { View, Text, StyleSheet } from 'react-native';
import MainLayout from '../components/MainLayout';

const HomeScreen = () => {
  return (
 
      <View style={styles.container}>
        <Text style={styles.title}>Bienvenido a VitalRisk</Text>
        <Text style={styles.description}>Administra tus equipos y mantenimientos de forma eficiente.</Text>
      </View>

  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 10,
    color: '#23998E',
  },
  description: {
    fontSize: 16,
    textAlign: 'center',
    color: '#555',
  },
});

export default HomeScreen;