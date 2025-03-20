import React, { useState } from 'react';
import { View, Text, Image, Switch, TouchableOpacity, StyleSheet } from 'react-native';
import Icon from 'react-native-vector-icons/FontAwesome';
import { useNavigation } from '@react-navigation/native';

const Profile = () => {
  const [isDarkMode, setIsDarkMode] = useState(false);
  const navigation = useNavigation();

  return (
    <View style={styles.container}>
      {/* Header */}
      <View style={styles.header}>
        <Icon name="arrow-left" size={24} color="#fff" onPress={() => navigation.goBack()} />
        <Text style={styles.headerTitle}>Profile</Text>
      </View>
      
      {/* Profile Info */}
      <View style={styles.profileContainer}>
        <Image source={{ uri: 'https://randomuser.me/api/portraits/men/1.jpg' }} style={styles.profileImage} />
        <TouchableOpacity style={styles.editIcon}>
          <Icon name="pencil" size={16} color="#fff" />
        </TouchableOpacity>
        <Text style={styles.profileName}>Kerry Petterson</Text>
        <Text style={styles.profileEmail}>hello@gmail.com</Text>
      </View>
      
      {/* Settings */}
      <View style={styles.section}>
        <Text style={styles.sectionTitle}>General Settings</Text>
        <View style={styles.settingItem}>
          <Icon name="cog" size={20} color="#000" />
          <Text style={styles.settingText}>Mode</Text>
          <Switch value={isDarkMode} onValueChange={setIsDarkMode} />
        </View>
        <TouchableOpacity style={styles.settingItem}>
          <Icon name="key" size={20} color="#000" />
          <Text style={styles.settingText}>Change Password</Text>
          <Icon name="chevron-right" size={16} color="#000" />
        </TouchableOpacity>
      </View>
      
      {/* Information */}
      <View style={styles.section}>
        <Text style={styles.sectionTitle}>Information</Text>
        {['About App', 'Terms & Conditions', 'Privacy Policy'].map((item, index) => (
          <TouchableOpacity key={index} style={styles.settingItem}>
            <Icon name={index === 0 ? 'info-circle' : index === 1 ? 'file-text' : 'shield'} size={20} color="#000" />
            <Text style={styles.settingText}>{item}</Text>
            <Icon name="chevron-right" size={16} color="#000" />
          </TouchableOpacity>
        ))}
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#fff' },
  header: { flexDirection: 'row', alignItems: 'center', backgroundColor: '#007a4e', padding: 15 },
  headerTitle: { color: '#fff', fontSize: 18, marginLeft: 20, fontWeight: 'bold' },
  profileContainer: { alignItems: 'center', marginTop: 20 },
  profileImage: { width: 100, height: 100, borderRadius: 50 },
  editIcon: { position: 'absolute', bottom: 10, right: 130, backgroundColor: '#007a4e', padding: 5, borderRadius: 20 },
  profileName: { fontSize: 18, fontWeight: 'bold', marginTop: 10 },
  profileEmail: { fontSize: 14, color: 'gray' },
  section: { marginTop: 20, paddingHorizontal: 20 },
  sectionTitle: { fontSize: 16, fontWeight: 'bold', color: 'gray', marginBottom: 10 },
  settingItem: { flexDirection: 'row', alignItems: 'center', paddingVertical: 15, borderBottomWidth: 1, borderBottomColor: '#ddd' },
  settingText: { flex: 1, marginLeft: 10, fontSize: 16 },
});

export default Profile;