import React from 'react';
import { View, StyleSheet } from 'react-native';
import Header from './Header';  // Asegúrate de que Header está en src/components
import Footer from './Footer';  // Asegúrate de que Footer está en src/components

const MainLayout = ({ children }) => {
  return (
    <View style={styles.container}>
      <Header />
      <View style={styles.content}>{children}</View>
      <Footer />
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
  content: {
    flex: 1, // Ocupa el espacio disponible entre Header y Footer
    padding: 10,
  },
});

export default MainLayout;
