import React from 'react';
import { View, Text, TouchableOpacity, StyleSheet } from 'react-native';
import MaterialIcons from 'react-native-vector-icons/MaterialIcons';
import FontAwesome from 'react-native-vector-icons/FontAwesome';

const Footer = () => {
  return (
    <View style={styles.footer}>
      <View style={styles.footerRow}>
        <TouchableOpacity style={styles.footerButton}>
          <MaterialIcons name="home" size={25} color="#7CBC9A" />
          <Text style={styles.footerText}>HOME</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.footerButton}>  
          <FontAwesome name="wrench" size={25} color="#7CBC9A" />
          <Text style={styles.footerText}>MAINTENANCE</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.footerButton}>
          <FontAwesome name="user" size={25} color="#7CBC9A" />
          <Text style={styles.footerText}>PROFILE</Text>
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
