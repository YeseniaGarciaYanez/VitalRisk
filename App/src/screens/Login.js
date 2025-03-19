import React, { useState } from 'react';
import { StyleSheet, Text, TextInput, Button, View, Image } from 'react-native';


export default function Login() {
    const image = require('');


    return (
        <View style={styles.container}>
            
            <Image style={styles.image} source={image} />

            <TextInput
                style={styles.input}
                placeholder="Enter ID"
                
            />
            <TextInput
                style={styles.input}
                placeholder="Enter password"
                
            />
           
            <Button title="Sign Up" color="#23998E" />
        </View>
    );
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        alignItems: 'center',
        justifyContent: 'center',
        padding: 16,
    },
    input: {
        width: '80%',
        height: 40,
        borderWidth: 1,
        borderColor: 'gray',
        marginBottom: 16,
        paddingLeft: 8,
    },
    resultText: {
        width: '80%',
        marginTop: 16,
        fontSize: 16,
    },
    image: {
        width: 200,
        height: 100,
        marginBottom: 50,
    },
});

