import React from 'react';
import { View, Image, StyleSheet } from 'react-native';

const Header = () => {
  const logo = require('../../Logo/logovital.png')
  return (
    <View style={styles.header}>
      <Image style={styles.image} source={logo}/>
    </View>
  );
};

const styles = StyleSheet.create({
  header: {
    position: 'absolute',
    top: 0,
    left: 0,
    right: 0,
    backgroundColor: '#23998E',
    paddingVertical: 15,
    justifyContent: 'center',
    alignItems: 'center',
    zIndex: 1, // Para asegurarte de que esté por encima de otros componentes si es necesario
  },
  image: {
    width: 50,
    height: 25,
  },
});

export default Header;
