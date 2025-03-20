import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import { View, Text, Button, StyleSheet } from 'react-native';

const Stack = createStackNavigator();

const HomeScreen = ({ navigation }) => {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>VitalRisk</Text>
      <Text style={styles.subtitle}>Sistema de Gestión de Mantenimiento</Text>
      <Button title="Ir a Dashboard" onPress={() => navigation.navigate('Dashboard')} />
    </View>
  );
};

const DashboardScreen = () => {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Dashboard</Text>
      <Text>Bienvenido al sistema de mantenimiento</Text>
    </View>
  );
};

export default function App() {
  return (
    <NavigationContainer>
      <Stack.Navigator>
        <Stack.Screen name="Inicio" component={HomeScreen} />
        <Stack.Screen name="Dashboard" component={DashboardScreen} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#f4f4f4',
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 10,
  },
  subtitle: {
    fontSize: 16,
    marginBottom: 20,
  },
});
