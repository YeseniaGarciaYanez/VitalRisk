import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import MainLayout from './src/components/MainLayout'; // Importa el layout
import LoginScreen from './src/screens/LoginScreen';
import RegisterScreen from './src/screens/RegisterScreen';
import HomeScreen from './src/screens/HomeScreen';
import Maintenance from './src/screens/Maintenance';
import ProfileScreen from './src/screens/ProfileScreen';
const Stack = createStackNavigator();

export default function App() {
  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="Login" screenOptions={{ headerShown: false }}>
        <Stack.Screen name="Login" component={LoginScreen} />
        <Stack.Screen name="Register" component={RegisterScreen} />

        {/* Envolver pantallas en MainLayout */}
        <Stack.Screen
          name="HomeScreen"
          component={(props) => (
            <MainLayout>
              <HomeScreen {...props} />
            </MainLayout>
          )}
        />
        <Stack.Screen
          name="Maintenance"
          component={(props) => (
            <MainLayout>
              <Maintenance {...props} />
            </MainLayout>
          )}
        />
        <Stack.Screen
          name="ProfileScreen"
          component={(props) => (
            <MainLayout>
              <ProfileScreen {...props} />
            </MainLayout>
          )}
        />
        
      </Stack.Navigator>
    </NavigationContainer>
  );
}
