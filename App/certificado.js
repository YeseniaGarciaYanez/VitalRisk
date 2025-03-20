import React, { useRef } from 'react';
import { View, Text, StyleSheet, TouchableOpacity } from 'react-native';
import { captureRef } from 'react-native-view-shot';
import Pdf from 'react-native-pdf-lib';
import * as Sharing from 'expo-sharing';
import * as FileSystem from 'expo-file-system';

const Certificado = ({ nombreEquipo, numeroSerie, fechaCertificacion }) => {
  const viewRef = useRef();

  const generarPDF = async () => {
    try {
      // Capturar la vista como imagen
      const uri = await captureRef(viewRef, {
        format: 'png',
        quality: 0.8,
      });

      // Ruta para guardar el PDF
      const pdfPath = `${FileSystem.documentDirectory}certificado.pdf`;

      // Crear el PDF usando la imagen capturada
      const pdf = await Pdf.PDFDocument.create(pdfPath);
      const page = Pdf.PDFPage.create()
        .setMediaBox(612, 792) // Tamaño de carta estándar
        .drawImage(uri, 'jpg', {
          x: 50,
          y: 500,
          width: 512,
          height: 288,
        });
      pdf.addPages(page);
      await pdf.write();

      // Compartir el archivo PDF
      await Sharing.shareAsync(pdfPath);
    } catch (error) {
      console.error('Error al generar el PDF:', error);
    }
  };

  return (
    <View style={styles.container}>
      {/* Certificado diseñado */}
      <View ref={viewRef} style={styles.certificado}>
        <Text style={styles.titulo}>Certificado de Equipo Médico</Text>
        <Text style={styles.texto}>📌 Nombre del Equipo: {nombreEquipo}</Text>
        <Text style={styles.texto}>🔢 Número de Serie: {numeroSerie}</Text>
        <Text style={styles.texto}>📅 Fecha de Certificación: {fechaCertificacion}</Text>
        <Text style={styles.firma}>_________________________{"\n"}Firma Autorizada</Text>
      </View>

      {/* Botón para descargar el PDF */}
      <TouchableOpacity style={styles.boton} onPress={generarPDF}>
        <Text style={styles.botonTexto}>Descargar Certificado (PDF)</Text>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f4f4f4',
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
    fontWeight: 'bold',
  },
});

export default Certificado;
