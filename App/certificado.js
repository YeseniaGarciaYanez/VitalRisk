import React from 'react';
import { View, Text, StyleSheet, TouchableOpacity } from 'react-native';

const Certificado = ({ nombreEquipo, numeroSerie, fechaCertificacion }) => {

  return (
    <View style={styles.container}>
      {/* Certificado diseñado */}
      <View style={styles.certificado}>
        <Text style={styles.titulo}>Medical Equipment Certificate</Text>
        <Text style={styles.texto}>📌 Equipment: {nombreEquipo}</Text>
        <Text style={styles.texto}>🔢 ID: {numeroSerie}</Text>
        <Text style={styles.texto}>📅 Certification date: {fechaCertificacion}</Text>
        <Text style={styles.firma}>_{"\n"}Authorized signature</Text>
      </View>

      {/* Botón opcional que simula una acción */}
      <TouchableOpacity style={styles.boton}>
        <Text style={styles.botonTexto}>Download</Text>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
    padding: 20,
  },
  certificado: {
    width: '90%',
    padding: 20,
    backgroundColor: '#ffffff',
    borderRadius: 10,
    borderWidth: 2,
    borderColor: '#4CAF50',
    elevation: 5,
    alignItems: 'center',
  },
  titulo: {
    fontSize: 24,
    fontWeight: 'bold',
    color: '#333333',  
    marginBottom: 15,
  },
  texto: {
    fontSize: 16,
    color: '#555555',
    marginBottom: 8,
  },
  firma: {
    fontSize: 14,
    color: '#777777',
    marginTop: 20,
    textAlign: 'center',
  },
  boton: {
    backgroundColor: '#4CAF50',
    paddingVertical: 12,
    paddingHorizontal: 30,
    borderRadius: 8,
    marginTop: 20,
  },
  botonTexto: {
    color: '#ffffff',
    fontSize: 16,
    textAlign: 'center',
  },
});

export default Certificado;