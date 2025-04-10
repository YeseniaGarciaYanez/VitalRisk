import React, { useState, useEffect } from 'react';
import { View, Text, StyleSheet, Alert, ActivityIndicator, ScrollView } from 'react-native';
import axios from 'axios';
import AsyncStorage from '@react-native-async-storage/async-storage';

const ProfileScreen = () => {
  const [hospital, setHospital] = useState(null);
  const [loading, setLoading] = useState(true);
  const [clues, setClues] = useState('');

  useEffect(() => {
    const fetchData = async () => {
      try {
        const storedClues = await AsyncStorage.getItem('clues');
        if (storedClues) {
          setClues(storedClues);

          const response = await axios.post('http://192.168.0.101/VitalRisk/App/src/apis/profile.php', { clues: storedClues });

          if (response.data.success && response.data.hospital) {
            setHospital(response.data.hospital);
          } else {
            Alert.alert('Error', 'No se encontró información del hospital.');
          }
        } else {
          Alert.alert('Error', 'No se ha encontrado el CLUES.');
        }
      } catch (error) {
        console.error('Error al obtener los datos del hospital:', error);
        Alert.alert('Error', 'No se pudo obtener los datos del hospital.');
      } finally {
        setLoading(false);
      }
    };
    fetchData();
  }, []);

  return (
    <ScrollView contentContainerStyle={styles.container}>
      {loading && <ActivityIndicator size="large" color="#23998E" />}

      {hospital && (
        <View style={styles.profileContainer}>
          <Text style={styles.title}>Perfil del Hospital</Text>
          <View style={styles.infoRow}>
            <Text style={styles.label}>CLUES:</Text>
            <Text style={styles.info}>{hospital.clues}</Text>
          </View>
          <View style={styles.infoRow}>
            <Text style={styles.label}>Nombre:</Text>
            <Text style={styles.info}>{hospital.nombre}</Text>
          </View>
          <View style={styles.infoRow}>
            <Text style={styles.label}>Entidad:</Text>
            <Text style={styles.info}>{hospital.entidad}</Text>
          </View>
          <View style={styles.infoRow}>
            <Text style={styles.label}>Municipio:</Text>
            <Text style={styles.info}>{hospital.municipio}</Text>
          </View>
        </View>
      )}
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    flexGrow: 1,
    backgroundColor: '#F4F7F9', // Un fondo más suave
    padding: 20,
    alignItems: 'center',
    justifyContent: 'center',
  },
  profileContainer: {
    padding: 20,
    borderRadius: 12, // Bordes un poco más redondeados
    backgroundColor: '#FFFFFF', // Fondo blanco para resaltar el contenido
    shadowColor: '#000', // Sombra sutil para dar profundidad
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.1,
    shadowRadius: 4,
    elevation: 3,
    marginTop: 20,
    width: '90%',
  },
  title: {
    fontSize: 26, // Título un poco más grande
    fontWeight: 'bold',
    color: '#23998E',
    textAlign: 'center',
    marginBottom: 25,
  },
  infoRow: {
    flexDirection: 'row', // Distribución horizontal para label e info
    justifyContent: 'space-between', // Espacio entre label e info
    marginBottom: 15,
  },
  label: {
    fontSize: 18,
    fontWeight: '600',
    color: '#34495E',
    flex: 1, // Permite que el label ocupe espacio
  },
  info: {
    fontSize: 18,
    color: '#555',
    flex: 1, // Permite que la info ocupe espacio
    textAlign: 'right', // Alinea la info a la derecha
  },
});

export default ProfileScreen;