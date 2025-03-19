import React from "react";
import { View, Text, FlatList, StyleSheet, Button } from "react-native";

const data = [
  { id: "1", name: "0130230202" },
  { id: "2", name: "0200101020" },
  { id: "3", name: "0203020102" },
  { id: "4", name: "3332493930" },
];

const UserManagement = () => {
  return (
    <View style={styles.container}>
      <FlatList
        data={data}
        keyExtractor={(item) => item.id}
        renderItem={({ item }) => (
          <View style={styles.item}>
            <Text style={styles.text}>{item.name} <Button style={styles.button}> More details </Button></Text>
            
          </View>
        )}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 20,
    width: '360px',
  },
  
  item: {
    backgroundColor: "#",
    padding: 15,
    marginVertical: 8,
    borderRadius: 10,
  },
  text: {
    color: "#000",
    fontSize: 18,
  },
  button: {
    marginLeft: 10,
  }
});

export default UserManagement;