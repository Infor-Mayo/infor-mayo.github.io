---
layout: cabeza3
---

# Clase QCalendarWidget
QCalendarWidget es un widget que proporciona una vista de calendario en Qt, lo cual permite a los usuarios seleccionar fechas de manera intuitiva mediante un calendario gráfico. Es un widget útil para aplicaciones donde se requiere seleccionar fechas de una manera visual y rápida, como en formularios, gestores de eventos, o selecciones de intervalos de tiempo.

***

## Características Principales
- Selección de fechas: Permite seleccionar una única fecha.
- Vista de meses y años: Muestra los días en un mes específico, y permite navegar entre meses y años.
- Formato personalizable: Se puede personalizar el formato en que las fechas se muestran (por ejemplo, nombres completos de meses o días de la semana).
- Controles adicionales: Puede incluir controles para navegar entre meses y años, así como mostrar el nombre de los días de la semana.

***

## Métodos Principales de QCalendarWidget
1. ### QCalendarWidget(QWidget *parent = nullptr)
    Constructor que crea un widget QCalendarWidget.
    Parámetros:
    - parent: El widget padre (opcional).

    Ejemplo:
    ```cpp
    QCalendarWidget *calendar = new QCalendarWidget();
    ```
2. ### QDate selectedDate() const
    Devuelve la fecha seleccionada en el calendario.

    Ejemplo:
    ```cpp
    QDate date = calendar->selectedDate();
    ```
3. ### void setSelectedDate(const QDate &date)
    Establece la fecha seleccionada en el calendario.

    Parámetros:
    - date: La fecha a seleccionar.

    Ejemplo:
    ```cpp
    calendar->setSelectedDate(QDate::currentDate());
    ```
4. ### QDate minimumDate() const
    Devuelve la fecha mínima que se puede seleccionar en el calendario.

    Ejemplo:
    ```cpp
    QDate minDate = calendar->minimumDate();
    ```
5. ### void setMinimumDate(const QDate &date)
    Establece la fecha mínima que se puede seleccionar en el calendario.

    Parámetros:
    - date: La fecha mínima a establecer.

    Ejemplo:
    ```cpp
    calendar->setMinimumDate(QDate(2020, 1, 1));
    ```
6. ### QDate maximumDate() const
    Devuelve la fecha máxima que se puede seleccionar en el calendario.

    Ejemplo:
    ```cpp
    QDate maxDate = calendar->maximumDate();
    ```
7. ### void setMaximumDate(const QDate &date)
    Establece la fecha máxima que se puede seleccionar en el calendario.

    Parámetros:
    - date: La fecha máxima a establecer.

    Ejemplo:
    ```cpp
    calendar->setMaximumDate(QDate(2025, 12, 31));
    ```
8. ### void setDateRange(const QDate &min, const QDate &max)
    Establece el rango de fechas permitidas en el calendario.

    Parámetros:
    - min: La fecha mínima.
    - max: La fecha máxima.

    Ejemplo:
    ```cpp
    calendar->setDateRange(QDate(2020, 1, 1), QDate(2025, 12, 31));
    ```
9. ### QString dateTextFormat(const QDate &date) const
    Devuelve el formato de texto para la fecha dada.

    Ejemplo:
    ```cpp
    QString format = calendar->dateTextFormat(QDate::currentDate());
    ```
10. ### void setDateTextFormat(const QDate &date, const QTextCharFormat &format)
    Establece el formato de texto para una fecha específica (por ejemplo, para resaltar días especiales).

    Parámetros:
    - date: La fecha a formatear.
    - format: El formato de texto a aplicar.

    Ejemplo:
    ```cpp
    QTextCharFormat format;
    format.setForeground(Qt::red); // Establece el texto en color rojo.
    calendar->setDateTextFormat(QDate::currentDate(), format);
    ```
11. ### QDate minimumDate() const
    Devuelve la fecha mínima que se puede seleccionar.

    Ejemplo:
    ```cpp
    QDate minDate = calendar->minimumDate();
    ```
12. ### bool isDateVisible(const QDate &date) const
    Verifica si la fecha proporcionada es visible en el calendario actual.

    Parámetros:
    - date: La fecha a verificar.

    Ejemplo:
    ```cpp
    bool visible = calendar->isDateVisible(QDate::currentDate());
    ```
13. ### void setFirstDayOfWeek(Qt::DayOfWeek dayOfWeek)
    Establece el primer día de la semana en el calendario (por ejemplo, lunes o domingo).

    Parámetros:
    - dayOfWeek: El día de la semana que se establecerá como el primero (por ejemplo, Qt::Monday).

    Ejemplo:
    ```cpp
    calendar->setFirstDayOfWeek(Qt::Monday);
    ```

***

## Señales Principales
1. ### void selectionChanged()
    Esta señal se emite cuando la fecha seleccionada en el calendario cambia.
    
    Ejemplo:
    ```cpp
    connect(calendar, &QCalendarWidget::selectionChanged, []() {
        qDebug() << "La fecha seleccionada ha cambiado";
    });
    ```
2. ### void activated(const QDate &date)
    Esta señal se emite cuando se activa una fecha (cuando se hace clic en una fecha).

    Ejemplo:
    ```cpp
    connect(calendar, &QCalendarWidget::activated, [](const QDate &date) {
        qDebug() << "Fecha activada:" << date;
    });
    ```
3. ### void clicked(const QDate &date)
    Esta señal se emite cuando el usuario hace clic en una fecha.

    Ejemplo:
    ```cpp
    connect(calendar, &QCalendarWidget::clicked, [](const QDate &date) {
        qDebug() << "Fecha clickeada:" << date;
    });
    ```

***

## Ejemplo Completo
```cpp
#include <QApplication>
#include <QCalendarWidget>
#include <QVBoxLayout>
#include <QLabel>
#include <QWidget>

class CalendarExample : public QWidget {
public:
    CalendarExample(QWidget *parent = nullptr) : QWidget(parent) {
        QVBoxLayout *layout = new QVBoxLayout(this);

        QLabel *label = new QLabel("Fecha seleccionada: ", this);
        QCalendarWidget *calendar = new QCalendarWidget(this);
        calendar->setMinimumDate(QDate(2020, 1, 1));
        calendar->setMaximumDate(QDate(2025, 12, 31));

        layout->addWidget(label);
        layout->addWidget(calendar);

        connect(calendar, &QCalendarWidget::selectionChanged, [=]() {
            label->setText("Fecha seleccionada: " + calendar->selectedDate().toString());
        });
    }
};

int main(int argc, char *argv[]) {
    QApplication app(argc, argv);

    CalendarExample window;
    window.show();

    return app.exec();
}
```

***

## Ejercicios de Consolidación
1.	Ejercicio 1: Restricción de Fechas
- Crea un QCalendarWidget que permita seleccionar solo fechas entre el 1 de enero de 2022 y el 31 de diciembre de 2023. Muestra la fecha seleccionada en una etiqueta.
2.	Ejercicio 2: Calendario con Fines de Semana en Rojo
- Implementa un QCalendarWidget que muestre los fines de semana (sábado y domingo) con texto en color rojo.
3.	Ejercicio 3: Selección de Eventos
- Crea una aplicación que permita seleccionar fechas en un QCalendarWidget, y en cada fecha seleccionada, añade un evento (como un recordatorio o cita). Usa un QListWidget para mostrar los eventos agregados.
4.	Ejercicio 4: Calendario de Cumpleaños
- Crea un QCalendarWidget que resalte ciertas fechas (por ejemplo, cumpleaños) con un formato especial (cambio de color o fuente).


