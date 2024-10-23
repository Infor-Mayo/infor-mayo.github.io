---
layout: cabeza3
---

# Clase QCryptographicHash
La clase QCryptographicHash de Qt proporciona una interfaz para calcular valores hash criptográficos usando diversos algoritmos estándar. Un valor hash es un resumen (digest) fijo, generado a partir de un conjunto de datos, y se utiliza en muchas áreas como la verificación de la integridad de los datos, autenticación, firmas digitales, entre otras.

***

## Algoritmos Soportados
QCryptographicHash soporta varios algoritmos de hash comunes:
- MD4: Protocolo hash ya obsoleto y no recomendado por problemas de seguridad.
- MD5: Algo más seguro que MD4, pero también con vulnerabilidades conocidas y no recomendado para nuevos desarrollos.
- SHA-1: Más seguro que MD5, pero aún vulnerable a ataques de colisión. También obsoleto.
- SHA-224, SHA-256, SHA-384, SHA-512: Parte de la familia SHA-2, son los algoritmos hash recomendados para usos criptográficos.

***

## Métodos Principales de QCryptographicHash
1. ### Constructor

    ```cpp
    QCryptographicHash(QCryptographicHash::Algorithm method);
    ```
    Crea un objeto QCryptographicHash para calcular el hash usando el algoritmo especificado.
    - method: Especifica el algoritmo de hash a usar, por ejemplo, QCryptographicHash::Sha256.

    Ejemplo:
    ```cpp
    QCryptographicHash hash(QCryptographicHash::Sha256);
    ```
2. ### addData()
    Este método se usa para añadir más datos al objeto de hash. Puede añadirse a través de una cadena de bytes (QByteArray), un puntero a datos o un flujo de datos.
    ```cpp
    bool addData(const QByteArray &data);
    bool addData(const char *data, qint64 length);
    ```

    Ejemplo:
    ```cpp
    QCryptographicHash hash(QCryptographicHash::Sha256);
    hash.addData("Hola, mundo");
    ```
3. ### result()
    Devuelve el valor hash calculado como un QByteArray. Este método debe llamarse una vez que todos los datos han sido añadidos.
    ```cpp
    QByteArray result() const;
    ```

    Ejemplo:
    ```cpp
    QCryptographicHash hash(QCryptographicHash::Sha256);
    hash.addData("Qt Framework");
    QByteArray digest = hash.result();
    qDebug() << "Hash SHA-256:" << digest.toHex();
    ```
4. ### hash()
    Este método estático permite calcular el hash de una única vez, sin necesidad de crear un objeto QCryptographicHash.
    ```cpp
    static QByteArray hash(const QByteArray &data, QCryptographicHash::Algorithm method);
    ```

    Ejemplo:
    ```cpp
    QByteArray hashValue = QCryptographicHash::hash("Qt Framework", QCryptographicHash::Sha256);
    qDebug() << "Hash calculado:" << hashValue.toHex();
    ```

5. ### reset()
    Reinicia el objeto QCryptographicHash, limpiando los datos actuales y permitiendo empezar el cálculo de un nuevo hash.
    ```cpp
    void reset();
    ```

    Ejemplo:
    ```cpp
    hash.reset();
    hash.addData("Nuevo contenido");
    ```

***

## Ejemplo Completo
A continuación se muestra un ejemplo que utiliza QCryptographicHash para calcular el hash SHA-256 de un archivo:
```cpp
#include <QCryptographicHash>
#include <QFile>
#include <QDebug>

int main() {
    QFile file("ruta/del/archivo.txt");
    if (!file.open(QIODevice::ReadOnly)) {
        qWarning() << "No se pudo abrir el archivo";
        return -1;
    }

    QCryptographicHash hash(QCryptographicHash::Sha256);
    
    if (!hash.addData(&file)) {
        qWarning() << "Error al añadir datos al hash";
        return -1;
    }
    
    QByteArray result = hash.result();
    qDebug() << "Hash SHA-256 del archivo:" << result.toHex();
    
    return 0;
}
```
Este programa abre un archivo y calcula su hash SHA-256, mostrándolo en formato hexadecimal.

***

## Ejercicios de Consolidación
1.	### Hash de Cadenas
- Escribe un programa que solicite al usuario una cadena de texto, calcule su hash usando SHA-256, y lo muestre en formato hexadecimal.
2.	### Verificación de Integridad
- Crea una función que tome dos archivos como entrada y compare sus valores hash (MD5) para determinar si son idénticos.
3.	### Hashes Progresivos
- Escribe un programa que lea un archivo en bloques de 1024 bytes, añadiendo cada bloque al QCryptographicHash y calcule el hash final una vez se haya procesado todo el archivo.
4.	### Implementación de un Almacén de Contraseñas
- Crea una pequeña aplicación que permita almacenar contraseñas seguras. Cada contraseña se debe guardar como un hash SHA-256. Añade la funcionalidad para verificar si una contraseña ingresada coincide con el hash guardado.

***

La clase QCryptographicHash es extremadamente útil para cualquier tipo de operación que requiera hashes criptográficos, desde verificación de integridad de datos hasta almacenamiento seguro de contraseñas.

