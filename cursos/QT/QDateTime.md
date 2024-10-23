---
layout: cabeza3
---

# Clase QDateTime
QDateTime es muy útil cuando necesitas trabajar con fechas y horas juntas en una sola entidad. La clase puede representar cualquier fecha y hora entre los años 2 y 9999, y te permite convertir entre diferentes zonas horarias, manipular fechas y horas, comparar tiempos, y más.
***
## Funcionalidades principales de QDateTime
1. ### Constructores de QDateTime
    - QDateTime(): Crea un objeto de QDateTime no válido.
    - QDateTime(const QDate &date, const QTime &time): Crea un objeto de QDateTime a partir de una fecha y hora específicos.
    - QDateTime(const QDate &date, const QTime &time, Qt::TimeSpec spec): Crea un objeto QDateTime con una zona horaria o especificación temporal (como UTC o local).

    Ejemplo:
    ```cpp
    QDate fecha(2024, 10, 6);
    QTime hora(12, 30);
    QDateTime fechaHora(fecha, hora);
    ```
2. ### Método currentDateTime()
    - QDateTime QDateTime::currentDateTime(): Devuelve la fecha y hora actuales según la zona horaria local.

    Ejemplo:
    ```cpp
    QDateTime fechaHoraActual = QDateTime::currentDateTime();
    qDebug() << "Fecha y hora actuales:" << fechaHoraActual.toString();
    ```
3. ### Método isValid()
    - bool isValid(): Comprueba si la fecha y hora representadas son válidas.

    Ejemplo:
    ```cpp
    QDateTime fechaHoraInvalida(QDate(2024, 2, 30), QTime(25, 61));  // Fecha y hora inválidas
    if (!fechaHoraInvalida.isValid()) {
        qDebug() << "Fecha y hora inválidas.";
    }
    ```
4. ### Métodos de manipulación de fechas y horas
    - addDays(int days): Devuelve un nuevo QDateTime con la fecha ajustada por el número de días.
    - addMonths(int months): Devuelve un nuevo QDateTime con la fecha ajustada por el número de meses.
    - addYears(int years): Devuelve un nuevo QDateTime con la fecha ajustada por el número de años.
    - addSecs(qint64 seconds): Ajusta la hora sumando o restando segundos.

    Ejemplo:
    ```cpp
    QDateTime fechaHora = QDateTime::currentDateTime();
    QDateTime nuevaFechaHora = fechaHora.addDays(10);  // Sumar 10 días
    qDebug() << "En 10 días será:" << nuevaFechaHora.toString();
    ```
5. ### Métodos de conversión entre zonas horarias
    - toTimeZone(const QTimeZone &): Convierte el QDateTime a una zona horaria específica.
    - toUTC(): Convierte la fecha y hora a UTC.
    - toLocalTime(): Convierte la fecha y hora a la zona horaria local.

    Ejemplo:
    ```cpp
    QDateTime fechaHoraUTC = QDateTime::currentDateTimeUtc();
    qDebug() << "Fecha y hora en UTC:" << fechaHoraUTC.toString();
    ```
6. ### Métodos de diferencia entre QDateTime
    - qint64 secsTo(const QDateTime &other): Devuelve el número de segundos entre la fecha y hora actual y otra.
    - qint64 daysTo(const QDateTime &other): Devuelve el número de días entre la fecha y hora actual y otra.

    Ejemplo:
    ```cpp
    QDateTime ahora = QDateTime::currentDateTime();
    QDateTime futuro = ahora.addDays(30);
    qint64 segundosHastaFuturo = ahora.secsTo(futuro);
    qDebug() << "Segundos hasta dentro de 30 días:" << segundosHastaFuturo;
    ```
7. ### Métodos de comparación de fechas y horas
    - bool operator==(const QDateTime &other): Compara si dos objetos QDateTime son iguales.
    - bool operator<(const QDateTime &other): Comprueba si la fecha y hora actual es anterior a la otra.

    Ejemplo:
    ```cpp
    QDateTime fechaHora1(QDate(2024, 10, 6), QTime(12, 30));
    QDateTime fechaHora2(QDate(2024, 12, 25), QTime(15, 0));

    if (fechaHora1 < fechaHora2) {
        qDebug() << "La primera fecha es anterior a la segunda.";
    }
    ```
8. ### Formato y conversión de QDateTime a cadena de texto
    - QString toString(Qt::DateFormat format): Convierte el QDateTime a una cadena de texto con el formato especificado.
    - QDateTime fromString(const QString &string, Qt::DateFormat format): Crea un QDateTime a partir de una cadena de texto con un formato específico.

    Ejemplo:
    ```cpp
    QDateTime fechaHora = QDateTime::currentDateTime();
    QString fechaHoraTexto = fechaHora.toString("dd.MM.yyyy hh:mm:ss");
    qDebug() << "Fecha y hora actual en texto:" << fechaHoraTexto;
    ```

***

## Ejemplos prácticos
1. ### Mostrar la fecha y hora actuales
Este ejemplo muestra cómo obtener y mostrar la fecha y hora actuales.
```cpp
#include <QCoreApplication>
#include <QDateTime>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QDateTime fechaHoraActual = QDateTime::currentDateTime();
    qDebug() << "Fecha y hora actuales:" << fechaHoraActual.toString("dd.MM.yyyy hh:mm:ss");

    return a.exec();
}
```
2. ### Sumar y restar tiempo
Este ejemplo muestra cómo agregar días y segundos a un QDateTime.
```cpp
#include <QCoreApplication>
#include <QDateTime>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QDateTime fechaHoraActual = QDateTime::currentDateTime();
    QDateTime fechaHoraFutura = fechaHoraActual.addDays(10).addSecs(3600);  // 10 días y 1 hora después

    qDebug() << "Fecha y hora actuales:" << fechaHoraActual.toString("dd.MM.yyyy hh:mm:ss");
    qDebug() << "En 10 días y 1 hora será:" << fechaHoraFutura.toString("dd.MM.yyyy hh:mm:ss");

    return a.exec();
}
```
3. ### Diferencia en segundos entre dos fechas
Este ejemplo muestra cómo calcular la diferencia en segundos entre dos fechas y horas.
```cpp
#include <QCoreApplication>
#include <QDateTime>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QDateTime ahora = QDateTime::currentDateTime();
    QDateTime futuro = ahora.addDays(30);
    
    qint64 segundosHastaFuturo = ahora.secsTo(futuro);
    qDebug() << "Segundos hasta dentro de 30 días:" << segundosHastaFuturo;

    return a.exec();
}
```
4. ### Conversiones entre zonas horarias
Este ejemplo muestra cómo convertir una fecha y hora entre UTC y la zona horaria local.
```cpp
#include <QCoreApplication>
#include <QDateTime>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QDateTime fechaHoraUTC = QDateTime::currentDateTimeUtc();
    QDateTime fechaHoraLocal = fechaHoraUTC.toLocalTime();

    qDebug() << "Fecha y hora en UTC:" << fechaHoraUTC.toString("dd.MM.yyyy hh:mm:ss");
    qDebug() << "Fecha y hora en hora local:" << fechaHoraLocal.toString("dd.MM.yyyy hh:mm:ss");

    return a.exec();
}
```
***
## Ejercicios de Consolidación
1.	Fecha y hora actual:
- Escribe un programa que imprima la fecha y hora actuales en el formato "dd-MM-yyyy hh:mm
".
2.	Validar fecha y hora:
- Escribe un programa que tome una fecha y hora específicas (año, mes, día, hora, minuto) y valide si son correctos.
3.	Diferencia entre fechas:
- Crea un programa que calcule cuántos segundos han pasado desde el comienzo del año hasta el momento actual.
4.	Suma de tiempo:
- Escribe un programa que tome la fecha y hora actuales, y les agregue 30 días y 5 horas. Muestra el resultado.
5.	Conversión UTC:
- Crea un programa que convierta la fecha y hora actuales a UTC y muestre ambas fechas (local y UTC).
6.	Ejercicio avanzado:
- Escribe un programa que le pida al usuario una fecha y hora, y luego calcule cuántos días y segundos faltan para esa fecha desde el momento actual.
***
Con esto ya tienes una sólida base para trabajar con fechas y horas utilizando la clase QDateTime. 