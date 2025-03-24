import React, { useState } from 'react';
import { StyleSheet, Text, TextInput, Button, View, Image } from 'react-native';

import Maintenance from './src/screens/Maintenance';
import Header from './src/components/Header';
import Footer from './src/components/Footer';
import Certificado from './certificado';

export default function App() {
    

    return (
        <View style = {styles.container}>
            <Header></Header>
            <Maintenance></Maintenance>
            <Footer></Footer>
        </View>
    );
}


const styles = StyleSheet.create({
    container: {
        flex: 1,
        alignItems: 'center',
        padding: 16,
    },
})
