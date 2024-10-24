---
layout: cabeza3
---

# Clase QMap
QMap es una clase de contenedor de Qt que almacena pares de clave-valor en una estructura ordenada. La clave sirve como índice y el valor es lo que se asocia a esa clave. Las claves se almacenan en orden ascendente, lo que permite buscar elementos de manera eficiente.
***
## Funcionalidades principales de QMap
1. ### Constructores de QMap
    - QMap(): Crea un mapa vacío.
    - QMap(const QMap &other): Crea una copia de otro mapa.

    Ejemplo:
    ```cpp
    QMap<QString, int> mapaVacio;                 // Mapa vacío
    QMap<QString, int> copiaMapa(mapaVacio);      // Crea una copia de otro mapa
    ```
2. ### Agregar y eliminar elementos
    - QMap::insert(const Key &key, const T &value): Inserta un par clave-valor en el mapa.
    - QMap::remove(const Key &key): Elimina la clave (y su valor asociado) del mapa.
    - QMap::clear(): Elimina todos los elementos del mapa.
    - Operador []: También puedes usar el operador [] para añadir o acceder a valores.

    Ejemplo:
    ```cpp
    QMap<QString, int> edades;
    edades.insert("Carlos", 25);  // Inserta el par ("Carlos", 25)
    edades["Ana"] = 30;           // También puedes usar el operador []

    edades.remove("Carlos");      // Elimina el par con la clave "Carlos"
    edades.clear();               // Elimina todos los elementos del mapa
    ```
3. ### Acceder a los elementos
    - QMap::value(const Key &key): Devuelve el valor asociado con la clave key. Si la clave no existe, devuelve el valor predeterminado.
    - QMap::operator[]: Devuelve una referencia al valor asociado con la clave, o agrega una nueva clave si no existe.
    - QMap::contains(const Key &key): Devuelve true si el mapa contiene la clave.
    
    Ejemplo:
    ```cpp
    QMap<QString, int> edades;
    edades.insert("Carlos", 25);

    int edadCarlos = edades.value("Carlos");   // 25
    int edadAna = edades.value("Ana", -1);     // Devuelve -1 porque "Ana" no está en el mapa

    if (edades.contains("Carlos")) {
        qDebug() << "Carlos está en el mapa.";
    }
    ```
4. ### Iterar sobre el mapa
    Puedes usar iteradores o un bucle for para recorrer los elementos del QMap.
    - QMap::keys(): Devuelve una lista de todas las claves en el mapa.
    - QMap::values(): Devuelve una lista de todos los valores en el mapa.
    
    Ejemplo:
    ```cpp
    QMap<QString, int> edades;
    edades["Carlos"] = 25;
    edades["Ana"] = 30;
    edades["Pedro"] = 22;

    // Iterar sobre las claves
    for (const QString &clave : edades.keys()) {
        qDebug() << clave << "tiene" << edades[clave] << "años.";
    }

    // Iterar sobre los valores
    for (int edad : edades.values()) {
        qDebug() << "Edad:" << edad;
    }
    ```
5. ### Tamaño y estado del mapa
    - QMap::size(): Devuelve el número de pares clave-valor en el mapa.
    - QMap::isEmpty(): Devuelve true si el mapa está vacío.
   
    Ejemplo:
    ```cpp
    QMap<QString, int> edades;
    edades["Carlos"] = 25;

    int tamano = edades.size();      // 1
    bool estaVacio = edades.isEmpty(); // false
    ```
6. ### Buscar elementos
    - QMap::find(const Key &key): Devuelve un iterador que apunta al par clave-valor si la clave existe, o al final si no existe.
    - QMap::constFind(const Key &key): Similar a find(), pero para iteradores constantes.

    Ejemplo:
    ```cpp
    QMap<QString, int> edades;
    edades["Carlos"] = 25;

    QMap<QString, int>::iterator it = edades.find("Carlos");
    if (it != edades.end()) {
        qDebug() << "Carlos tiene" << it.value() << "años.";
    } else {
        qDebug() << "Carlos no está en el mapa.";
    }
    ```
7. ### Ordenar el mapa
    Las claves en QMap siempre están ordenadas en orden ascendente de acuerdo con el operador < de la clave.

    Ejemplo:
    ```cpp
    QMap<QString, int> edades;
    edades["Pedro"] = 22;
    edades["Carlos"] = 25;
    edades["Ana"] = 30;

    // El orden natural será: Ana, Carlos, Pedro (alfabéticamente)
    for (const QString &clave : edades.keys()) {
        qDebug() << clave << "tiene" << edades[clave] << "años.";
    }
    ```
8. ### Convertir QMap a otros tipos
    - QMap::toStdMap(): Convierte el QMap en un std::map de C++ estándar.

    Ejemplo:
    ```cpp
    QMap<QString, int> edades;
    edades["Carlos"] = 25;
    std::map<QString, int> stdMap = edades.toStdMap();
    ```
***
## Ejemplos prácticos
1. ### Usar QMap para almacenar edades de personas
```cpp
#include <QCoreApplication>
#include <QMap>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QMap<QString, int> edades;
    edades.insert("Carlos", 25);
    edades["Ana"] = 30;
    edades["Pedro"] = 22;

    qDebug() << "Edad de Carlos:" << edades.value("Carlos");
    qDebug() << "Edad de Ana:" << edades["Ana"];

    edades.remove("Pedro");  // Elimina a "Pedro" del mapa

    return a.exec();
}
```
2. ### Iterar sobre un QMap
```cpp
#include <QCoreApplication>
#include <QMap>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QMap<QString, int> edades;
    edades["Carlos"] = 25;
    edades["Ana"] = 30;
    edades["Pedro"] = 22;

    // Iterar sobre las claves
    for (const QString &clave : edades.keys()) {
        qDebug() << clave << "tiene" << edades[clave] << "años.";
    }

    return a.exec();
}
```
3. ### Buscar en un QMap
```cpp
#include <QCoreApplication>
#include <QMap>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QMap<QString, int> edades;
    edades["Carlos"] = 25;
    edades["Ana"] = 30;

    QString nombre = "Carlos";
    if (edades.contains(nombre)) {
        qDebug() << nombre << "está en el mapa y tiene" << edades.value(nombre) << "años.";
    } else {
        qDebug() << nombre << "no está en el mapa.";
    }

    return a.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Mapa de estudiantes y calificaciones:
- Crea un QMap que almacene los nombres de los estudiantes y sus calificaciones. Permite al usuario agregar nuevos estudiantes y buscar la calificación de un estudiante dado.
2.	### Eliminar elementos del mapa:
- Escribe un programa que permita al usuario eliminar una clave del QMap si existe, y mostrar un mensaje en caso de que no exista.
3.	### Contar elementos en el mapa:
- Crea un programa que cuente cuántos estudiantes hay en un QMap y los muestre en consola.
4.	### Actualizar valores en el mapa:
- Escribe un programa que permita al usuario actualizar la calificación de un estudiante en un QMap usando su nombre como clave.
5.	### Iterar sobre pares clave-valor:
- Crea un QMap con nombres de países y sus capitales, y usa un bucle para imprimir cada país y su capital.
***
Esto cubre las funcionalidades más importantes de la clase QMap.