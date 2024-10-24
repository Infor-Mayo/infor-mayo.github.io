---
layout: cabeza3
---

# Clase QLocale
QLocale es una clase de Qt que proporciona soporte para la internacionalización y regionalización. Su propósito es gestionar el formato de números, monedas, fechas, horas, y otros elementos específicos de una región o idioma particular. QLocale permite que las aplicaciones adapten su comportamiento según las convenciones culturales de diferentes países y lenguajes.

## Principales Características de QLocale
- Formato de números (decimales y enteros).
- Formato de monedas.
- Conversión de números a cadenas y viceversa.
- Formato de fechas y horas.
- Soporte para diferentes idiomas y regiones.
- Gestión de formatos de medida (como metros, kilogramos, etc.).
***
## Constructores de QLocale
1. ### QLocale()
    Crea un QLocale que utiliza la configuración predeterminada del sistema (idioma y región actual).

    Ejemplo:
    ```cpp
    QLocale locale;
    ```
2. ### QLocale(QLocale::Language language, QLocale::Country country = QLocale::AnyCountry)
    Crea un QLocale que usa el idioma y el país especificados.

    Parámetros:
    - language: El idioma deseado (por ejemplo, QLocale::English).
    - country: El país deseado (por ejemplo, QLocale::UnitedStates).

    Ejemplo:
    ```cpp
    QLocale locale(QLocale::Spanish, QLocale::Mexico);
    ```
3. ### QLocale(const QString &name)
    Crea un QLocale basado en el nombre de la configuración regional, como "es_ES" para español de España o "en_US" para inglés de Estados Unidos.

    Ejemplo:
    ```cpp
    QLocale locale("fr_FR");  // Francés de Francia
    ```
***
## Métodos Principales de QLocale
1. ### QString toString(int value) const
    Convierte un número entero en una cadena de texto según las convenciones locales.

    Ejemplo:
    ```cpp
    QLocale locale(QLocale::English, QLocale::UnitedStates);
    QString numberString = locale.toString(123456);
    qDebug() << numberString;  // "123,456" en inglés (EE.UU.)
    ```
2. ### QString toString(double value, char f = 'g', int prec = 6) const
    Convierte un número de punto flotante en una cadena de texto según las convenciones locales.

    Ejemplo:
    ```cpp
    QLocale locale(QLocale::German, QLocale::Germany);
    QString numberString = locale.toString(1234.56);
    qDebug() << numberString;  // "1.234,56" en alemán
    ```
3. ### QString toCurrencyString(double value, const QString &symbol = QString()) const
    Convierte un valor monetario en una cadena de texto con el formato de moneda según la convención local. Opcionalmente, puedes proporcionar un símbolo de moneda específico.

    Ejemplo:
    ```cpp
    QLocale locale(QLocale::English, QLocale::UnitedStates);
    QString currencyString = locale.toCurrencyString(1234.56);
    qDebug() << currencyString;  // "$1,234.56"
    ```
4. ### QString toCurrencyString(qint64 value, const QString &symbol = QString()) const
    Convierte un valor entero de moneda en una cadena de texto con el formato adecuado.

    Ejemplo:
    ```cpp
    QLocale locale(QLocale::Japanese, QLocale::Japan);
    QString currencyString = locale.toCurrencyString(100000);
    qDebug() << currencyString;  // "￥100,000"
    ```
5. ### QString toString(const QDate &date, QLocale::FormatType format = QLocale::LongFormat) const
    Convierte una fecha (QDate) en una cadena de texto con el formato especificado.

    Parámetros:
    - date: La fecha a formatear.
    - format: El formato de la fecha, que puede ser LongFormat, ShortFormat o NarrowFormat.

    Ejemplo:
    ```cpp
    QLocale locale(QLocale::English, QLocale::UnitedStates);
    QString dateString = locale.toString(QDate::currentDate(), QLocale::LongFormat);
    qDebug() << dateString;  // "October 6, 2024"
    ```
6. ### QString toString(const QTime &time, QLocale::FormatType format = QLocale::LongFormat) const
    Convierte una hora (QTime) en una cadena de texto con el formato especificado.
    
    Ejemplo:
    ```cpp
    QLocale locale(QLocale::Spanish, QLocale::Spain);
    QString timeString = locale.toString(QTime::currentTime(), QLocale::LongFormat);
    qDebug() << timeString;  // "18:34:12"
    ```
7. ### QDateTime toDateTime(const QString &string, QLocale::FormatType format = QLocale::LongFormat) const
    Convierte una cadena de texto en un objeto QDateTime, interpretando la cadena según las convenciones locales.

    Ejemplo:
    ```cpp
    QLocale locale(QLocale::French, QLocale::France);
    QDateTime dateTime = locale.toDateTime("6 octobre 2024", QLocale::LongFormat);
    ```
8. ### QChar decimalPoint() const
    Devuelve el carácter utilizado como separador decimal en la configuración regional.

    Ejemplo:
    ```cpp
    QLocale locale(QLocale::German, QLocale::Germany);
    QChar decimalChar = locale.decimalPoint();  // Devuelve ','
    ```
9. ### QString languageToString(QLocale::Language language)
    Convierte un valor de tipo QLocale::Language a su representación en cadena.

    Ejemplo:
    ```cpp
    QString lang = QLocale::languageToString(QLocale::English);
    qDebug() << lang;  // "English"
    ```
***
## Ejemplos
1. ### Formateo de Números
```cpp
#include <QLocale>
#include <QDebug>

int main() {
    QLocale locale(QLocale::French, QLocale::France);
    double value = 1234.56;
    qDebug() << locale.toString(value);  // "1 234,56"
    
    return 0;
}
```
2. ### Conversión de Moneda
```cpp
#include <QLocale>
#include <QDebug>

int main() {
    QLocale locale(QLocale::English, QLocale::UnitedStates);
    qDebug() << locale.toCurrencyString(1234.56);  // "$1,234.56"
    
    return 0;
}
```
3. ### Formato de Fecha
```cpp
#include <QLocale>
#include <QDebug>
#include <QDate>

int main() {
    QLocale locale(QLocale::Spanish, QLocale::Mexico);
    QDate date(2024, 10, 6);
    qDebug() << locale.toString(date, QLocale::LongFormat);  // "6 de octubre de 2024"
    
    return 0;
}
```
***
## Ejercicios de Consolidación
1.	### Formateo de Números
- Crea una aplicación que muestre un número en diferentes formatos regionales, utilizando al menos cinco locales distintos. Por ejemplo, muestra el número 1234.56 en formatos de EE.UU., Francia, Alemania, Japón y Brasil.
2.	### Formato de Fecha y Hora
- Crea una aplicación que muestre la fecha y la hora actual en formato largo, corto y estrecho en diferentes locales. Usa QLocale::toString() para formatear tanto la fecha como la hora.
3.	### Conversión de Monedas
- Implementa una aplicación que permita al usuario ingresar un valor numérico y seleccione una región, y luego muestre el valor formateado como una moneda en la región seleccionada.
4.	### Identificación de Locale
- Crea una aplicación que detecte el QLocale predeterminado del sistema y muestre la configuración de idioma, país, separador decimal y formato de moneda.

