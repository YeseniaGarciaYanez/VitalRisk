import React from 'react';
import { View, Text, StyleSheet, Image } from 'react-native';


const img = require('../../Logo/equipo.png');

const HomeScreen = () => {
  return (
 
      <View style={styles.container}>
        <Text style={styles.title}>Bienvenido a VitalRisk</Text>
        <Text style={styles.description}>Administra tus equipos y mantenimientos de forma eficiente.</Text>
        <Image style={styles.image} source={img} />
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
  image: {
    width: 300,
    height: 250,
    marginBottom: 80,
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