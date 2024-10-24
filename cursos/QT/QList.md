---
layout: cabeza3
---

# Clase QList
QList es una clase de Qt que representa una lista ordenada de elementos. A diferencia de un array tradicional, QList puede cambiar de tamaño dinámicamente, lo que la hace muy útil cuando no conocemos de antemano cuántos elementos vamos a almacenar. También ofrece una amplia gama de funciones para manipular la lista, como añadir, eliminar y buscar elementos.
***
## Funcionalidades principales de QList
1. ### Constructores de QList
    - QList(): Crea una lista vacía.
    - QList(int size): Crea una lista con size elementos vacíos.
    - QList(const QList &other): Crea una copia de otra lista.

    Ejemplo:
    ```cpp
    QList<int> listaVacia;                  // Lista vacía
    QList<int> listaConTamano(5);           // Lista con 5 elementos vacíos
    QList<int> copiaLista(listaConTamano);  // Copia de una lista
    ```
2. ### Agregar y eliminar elementos
    - QList::append(const T &value): Añade un elemento al final de la lista.
    - QList::prepend(const T &value): Añade un elemento al principio de la lista.
    - QList::insert(int i, const T &value): Inserta un elemento en la posición i.
    - QList::removeAt(int i): Elimina el elemento en la posición i.
    - QList::removeOne(const T &value): Elimina la primera aparición de value.
    - QList::clear(): Elimina todos los elementos de la lista.

    Ejemplo:
    ```cpp
    QList<int> numeros;
    numeros.append(10);   // Añade 10 al final
    numeros.prepend(5);   // Añade 5 al principio
    numeros.insert(1, 7); // Inserta 7 en la posición 1

    numeros.removeAt(2);  // Elimina el elemento en la posición 2
    numeros.removeOne(5); // Elimina la primera aparición de 5
    numeros.clear();      // Vacía la lista
    ```
3. ### Acceder a los elementos
    - QList::at(int i): Devuelve el elemento en la posición i.
    - QList::first(): Devuelve el primer elemento de la lista.
    - QList::last(): Devuelve el último elemento de la lista.
    - Operador []: Acceso directo a los elementos por su índice.

    Ejemplo:
    ```cpp
    QList<int> lista = {1, 2, 3, 4, 5};
    int primero = lista.first();    // 1
    int ultimo = lista.last();      // 5
    int segundo = lista[1];         // 2
    ```
4. ### Tamaño y estado de la lista
    - QList::size(): Devuelve el número de elementos en la lista.
    - QList::isEmpty(): Devuelve true si la lista está vacía.

    Ejemplo:
    ```cpp
    QList<int> lista = {1, 2, 3};
    int tamano = lista.size();      // 3
    bool estaVacia = lista.isEmpty(); // false
    ```
5. ### Buscar elementos
    - QList::contains(const T &value): Devuelve true si la lista contiene el elemento value.
    - QList::indexOf(const T &value, int from = 0): Devuelve el índice de la primera aparición de value a partir de from.
    - QList::lastIndexOf(const T &value, int from = -1): Devuelve el índice de la última aparición de value a partir de from.

    Ejemplo:
    ```cpp
    QList<int> lista = {1, 2, 3, 2, 5};
    if (lista.contains(3)) {
        qDebug() << "La lista contiene el número 3.";
    }

    int indice = lista.indexOf(2);      // Devuelve 1 (primera aparición de 2)
    int ultimoIndice = lista.lastIndexOf(2); // Devuelve 3 (última aparición de 2)
    ```
6. ### Ordenar la lista
    - QList::sort(): Ordena los elementos de la lista en orden ascendente.

    Ejemplo:
    ```cpp
    QList<int> numeros = {4, 1, 3, 2};
    std::sort(numeros.begin(), numeros.end());
    // Lista después de ordenar: {1, 2, 3, 4}
    ```
7. ### Iteración sobre la lista
    - Puedes usar un bucle for o un iterador para recorrer los elementos de la lista.

    Ejemplo:
    ```cpp
    QList<int> numeros = {1, 2, 3, 4};
    for (int numero : numeros) {
        qDebug() << numero;
    }
    ```
8. ### Convertir QList a otros tipos
    - QList::toVector(): Convierte la lista en un QVector.
    - QList::toSet(): Convierte la lista en un QSet.

    Ejemplo:
    ```cpp
    QList<int> lista = {1, 2, 3};
    QVector<int> vector = lista.toVector();
    QSet<int> conjunto = lista.toSet();
    ```
***
## Ejemplos prácticos
1. ### Agregar y eliminar elementos en QList
```cpp
#include <QCoreApplication>
#include <QList>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QList<int> lista;
    lista.append(1);  // Añade 1 al final
    lista.append(2);  // Añade 2 al final
    lista.prepend(0); // Añade 0 al principio

    lista.removeOne(1);  // Elimina la primera aparición de 1
    lista.removeAt(0);   // Elimina el primer elemento

    qDebug() << lista;  // Muestra el contenido de la lista

    return a.exec();
}
```
2. ### Buscar elementos en QList
```cpp
#include <QCoreApplication>
#include <QList>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QList<int> lista = {10, 20, 30, 20, 50};

    if (lista.contains(30)) {
        qDebug() << "La lista contiene 30.";
    }

    int indice = lista.indexOf(20);       // Primera aparición de 20
    int ultimoIndice = lista.lastIndexOf(20); // Última aparición de 20

    qDebug() << "Índice de la primera aparición de 20:" << indice;
    qDebug() << "Índice de la última aparición de 20:" << ultimoIndice;

    return a.exec();
}
```
3. ### Iterar sobre una QList
```cpp
#include <QCoreApplication>
#include <QList>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QList<QString> nombres = {"Carlos", "Ana", "Pedro"};
    for (const QString &nombre : nombres) {
        qDebug() << "Nombre:" << nombre;
    }

    return a.exec();
}
```
4. ### Ordenar una lista
```cpp
#include <QCoreApplication>
#include <QList>
#include <QDebug>
#include <algorithm>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QList<int> numeros = {5, 3, 8, 1, 9};
    std::sort(numeros.begin(), numeros.end()); // Ordenar lista

    qDebug() << "Lista ordenada:" << numeros;

    return a.exec();
}
```
***
## Ejercicios de Consolidación
1.	### Crear una lista de nombres:
- Crea una lista de QString que contenga los nombres de tus amigos y usa un bucle para imprimir cada nombre en consola.
2. ###	Agregar y eliminar elementos:
- Escribe un programa que permita agregar números enteros a una lista y luego permita eliminar un número específico que el usuario elija.
3. ###	Buscar elementos:
- Crea una lista de números enteros y escribe un programa que busque la primera y la última aparición de un número que el usuario ingrese.
4. ### Ordenar una lista de palabras:
- Crea una lista de palabras y ordénala alfabéticamente usando std::sort.
5. ###	Convertir listas:
- Escribe un programa que convierta una QList de números enteros en un QVector y luego en un QSet.
***
Con esto cubrimos las funcionalidades esenciales de la clase QList. 
