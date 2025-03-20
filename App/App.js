import React, { useState } from 'react';
import { StyleSheet, Text, TextInput, Button, View, Image } from 'react-native';

import Maintenance from './src/screens/Maintenance';
import Header from './src/components/Header';
import Footer from './src/components/Footer';
import Profile from './src/screens/Profile';

export default function App() {
    

    return (
        <View style = {styles.container}>
            <Profile></Profile>
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
