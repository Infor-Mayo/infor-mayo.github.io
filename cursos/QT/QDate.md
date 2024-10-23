---
layout: cabeza3
---


# Clase QDate
La clase QDate maneja fechas en el calendario gregoriano, el cual es el calendario más comúnmente utilizado. Proporciona múltiples métodos para crear, modificar y consultar fechas. También soporta la validación de fechas y operaciones como agregar o restar días.

***

## Funcionalidades principales de QDate
1. ### Constructores de QDate
    - QDate(): Crea un objeto de fecha no válido.
    - QDate(int year, int month, int day): Crea una fecha específica basada en el año, mes y día proporcionados.

    Ejemplo:
    ```cpp
    QDate fecha1;  // Fecha no válida
    QDate fecha2(2024, 10, 6);  // 6 de octubre de 2024
    ```
2. ### Método currentDate()
    - QDate QDate::currentDate(): Devuelve la fecha actual basada en el reloj del sistema.

    Ejemplo:
    ```cpp
    QDate hoy = QDate::currentDate();
    qDebug() << "Hoy es:" << hoy.toString();
    ```
3. ### Método isValid()
    - bool isValid(): Comprueba si la fecha es válida. Por ejemplo, 30 de febrero no es una fecha válida.

    Ejemplo:
    ```cpp
    QDate fecha(2024, 2, 30);  // Fecha inválida
    if (!fecha.isValid()) {
        qDebug() << "La fecha es inválida.";
    }
    ```
4. ### Método daysInMonth() y daysInYear()
    - int daysInMonth(): Devuelve la cantidad de días en el mes de la fecha actual.
    - int daysInYear(): Devuelve la cantidad de días en el año de la fecha actual.

    Ejemplo:
    ```cpp
    QDate fecha(2024, 10, 6);
    qDebug() << "Días en el mes:" << fecha.daysInMonth();  // 31
    qDebug() << "Días en el año:" << fecha.daysInYear();  // 366 (2024 es bisiesto)
    ```
5. ### Métodos de manipulación de fechas
    - addDays(int n): Devuelve una nueva fecha sumando o restando n días.
    - addMonths(int n): Devuelve una nueva fecha sumando o restando n meses.
    - addYears(int n): Devuelve una nueva fecha sumando o restando n años.
    Ejemplo:
    ```cpp
    QDate fecha(2024, 10, 6);
    QDate nuevaFecha = fecha.addDays(10);  // 16 de octubre de 2024
    qDebug() << "Nueva fecha:" << nuevaFecha.toString();
    ```
6. ### Métodos de diferencia entre fechas
    - int daysTo(const QDate &d): Devuelve la cantidad de días entre la fecha actual y d.
    - int daysInMonth(): Devuelve la cantidad de días del mes.

    Ejemplo:
    ```cpp
    QDate fecha1(2024, 10, 6);
    QDate fecha2(2024, 12, 25);
    int dias = fecha1.daysTo(fecha2);  // Días entre el 6 de octubre y el 25 de diciembre
    qDebug() << "Días hasta Navidad:" << dias;  // 80 días
    ```
7. ### Formato y conversión de fechas
    - QString toString(Qt::DateFormat format = Qt::TextDate): Convierte la fecha a una cadena de texto en un formato específico.
    - QDate fromString(const QString &string, Qt::DateFormat format = Qt::TextDate): Crea una fecha a partir de una cadena.

    Ejemplo:
    ```cpp
    QDate fecha(2024, 10, 6);
    QString fechaTexto = fecha.toString("dd.MM.yyyy");  // "06.10.2024"
    qDebug() << "Fecha en texto:" << fechaTexto;
    ```
8. ### Métodos de comparación de fechas
    - bool operator==(const QDate &d): Comprueba si dos fechas son iguales.
    - bool operator<(const QDate &d): Comprueba si la fecha es anterior a otra.
    
    Ejemplo:
    ```cpp
    QDate fecha1(2024, 10, 6);
    QDate fecha2(2024, 12, 25);
    if (fecha1 < fecha2) {
        qDebug() << "El 6 de octubre es antes que el 25 de diciembre.";
    }
    ```
9. ### QDate::longDayName() y shortDayName()
    - QString longDayName(int day): Devuelve el nombre completo del día de la semana (lunes, martes, etc.).
    - QString shortDayName(int day): Devuelve el nombre corto del día de la semana (lun., mar., etc.).

    Ejemplo:
    ```cpp
    Copiar código
    int diaSemana = QDate::currentDate().dayOfWeek();
    QString nombreDia = QDate::longDayName(diaSemana);
    qDebug() << "Hoy es:" << nombreDia;  // Hoy es "domingo", por ejemplo
    ```

***

## Ejemplos prácticos
1. ### Mostrar la fecha actual
Este ejemplo muestra cómo obtener y mostrar la fecha actual.
```cpp
Copiar código
#include <QCoreApplication>
#include <QDate>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QDate fechaHoy = QDate::currentDate();
    qDebug() << "Hoy es:" << fechaHoy.toString("dd.MM.yyyy");

    return a.exec();
}
```
2. ### Diferencia entre dos fechas
Este ejemplo calcula el número de días entre dos fechas.
```cpp
Copiar código
#include <QCoreApplication>
#include <QDate>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QDate fecha1(2024, 10, 6);
    QDate fecha2(2024, 12, 25);
    
    int dias = fecha1.daysTo(fecha2);
    qDebug() << "Días entre el 6 de octubre y el 25 de diciembre:" << dias;

    return a.exec();
}
```
3. ### Validar una fecha
Este ejemplo valida si una fecha es válida o no.
```cpp
Copiar código
#include <QCoreApplication>
#include <QDate>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QDate fechaInvalida(2024, 2, 30);  // Fecha no válida

    if (!fechaInvalida.isValid()) {
        qDebug() << "La fecha es inválida.";
    }

    return a.exec();
}
```
4. ### Agregar días a una fecha
Este ejemplo muestra cómo agregar días a una fecha existente.
```cpp
Copiar código
#include <QCoreApplication>
#include <QDate>
#include <QDebug>

int main(int argc, char *argv[]) {
    QCoreApplication a(argc, argv);

    QDate fechaHoy = QDate::currentDate();
    QDate nuevaFecha = fechaHoy.addDays(10);  // Sumar 10 días

    qDebug() << "Hoy es:" << fechaHoy.toString("dd.MM.yyyy");
    qDebug() << "En 10 días será:" << nuevaFecha.toString("dd.MM.yyyy");

    return a.exec();
}
```

***

## Ejercicios de Consolidación
1.	Fecha actual:
- Escribe un programa que imprima la fecha actual en el formato "día-mes-año" (por ejemplo, "06-10-2024").
2.	Validación de fecha:
- Escribe un programa que tome una fecha específica (año, mes y día) y valide si es una fecha correcta.
3.	Cálculo de diferencias:
- Crea un programa que calcule cuántos días faltan para el próximo año nuevo (1 de enero del próximo año).
4.	Agregar días y meses:
- Escribe un programa que tome la fecha de hoy, le agregue 50 días y luego 3 meses, y muestre la nueva fecha resultante.
5.	Nombre del día:
- Escribe un programa que imprima el nombre del día de la semana de la fecha actual.
6.	Ejercicio avanzado:
- Crea un programa que pida al usuario que introduzca dos fechas y luego imprima cuántos días, meses y años de diferencia hay entre ellas.

***

Con esto ya tienes una visión completa de cómo usar la clase QDate en Qt para manejar y manipular fechas.

