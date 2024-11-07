import tkinter as tk
from tkinter import ttk, messagebox

# Crear la ventana principal
root = tk.Tk()
root.title("Captura de Participantes")
root.geometry("500x500")
root.config(bg="#e0f7fa")  # Fondo en un color suave

# Estilos de colores y fuentes
style = ttk.Style()
style.configure("TButton", font=("Arial", 10, "bold"), padding=6, background="#00796b", foreground="black")
style.configure("TLabel", font=("Arial", 10), background="#e0f7fa")
style.configure("Treeview.Heading", font=("Arial", 10, "bold"), background="#004d40", foreground="black")

# Listas para almacenar los datos de participantes
participantes = []

# Función para agregar participante
def agregar_participante():
    nombre = nombre_entry.get()
    correo = correo_entry.get()
    
    if nombre and correo:
        participantes.append((nombre, correo))
        nombre_entry.delete(0, tk.END)
        correo_entry.delete(0, tk.END)
    else:
        messagebox.showwarning("Advertencia", "Por favor, ingresa el nombre y el correo.")


# Función para confirmar participantes
def confirmar_participantes():
    if participantes:
        messagebox.showinfo("Confirmación", f"{len(participantes)} participantes confirmados.")
    else:
        messagebox.showwarning("Advertencia", "No hay participantes para confirmar.")


# Etiquetas y entradas para capturar nombre y correo
ttk.Label(root, text="Nombre del participante:").grid(row=0, column=0, padx=10, pady=10, sticky="w")
nombre_entry = ttk.Entry(root, width=30)
nombre_entry.grid(row=0, column=1, padx=10, pady=10)

ttk.Label(root, text="Correo electrónico:").grid(row=1, column=0, padx=10, pady=10, sticky="w")
correo_entry = ttk.Entry(root, width=30)
correo_entry.grid(row=1, column=1, padx=10, pady=10)

# Botones para agregar y eliminar participante
boton_frame = tk.Frame(root, bg="#e0f7fa")
boton_frame.grid(row=2, column=0, columnspan=2, pady=10)

agregar_btn = ttk.Button(boton_frame, text="Agregar Participante", command=agregar_participante)
agregar_btn.grid(row=0, column=0, padx=5)
agregar_btn.configure(style="TButton")



# Botón para confirmar participantes
confirmar_btn = ttk.Button(root, text="Confirmar Participantes", command=confirmar_participantes)
confirmar_btn.grid(row=4, column=0, columnspan=2, pady=20)
confirmar_btn.configure(style="TButton")

# Ejecutar la ventana principal
root.mainloop()


'''Checklist de Criterios de Aceptación
Agregar Participante

- Si el organizador no ha ingresado un nombre o correo electrónico,
entonces debe aparecer un mensaje de advertencia indicando que ambos campos son obligatorios.


Confirmar Participantes

- Dado que hay al menos un participante en la lista,
cuando el organizador hace clic en "Confirmar Participantes",
entonces debe aparecer un mensaje de confirmación mostrando el número de participantes agregados.

 Dado que no hay participantes en la lista,
cuando el organizador hace clic en "Confirmar Participantes",
entonces debe aparecer un mensaje de advertencia indicando que no hay participantes para confirmar.

Interfaz Visual y Usabilidad

 Dado que el organizador abre la aplicación,
cuando visualiza la interfaz,
entonces todos los elementos deben ser visibles, y los colores de fondo y de los botones deben permitir una lectura y uso claros.
 Los botones deben ser accesibles y estar bien alineados para facilitar la interacción.
 Los campos de entrada deben estar lo suficientemente largos para capturar nombres y correos sin dificultad.
 El diseño debe ajustarse a la ventana de 500x500 y mostrar correctamente todos los elementos en pantalla.
Manejo de Datos en la Lista

 Dado que el organizador ha agregado un participante,
cuando se visualiza la lista de participantes interna,
entonces debe reflejar correctamente los datos ingresados, sin duplicados ni omisiones.
 La lista participantes debe contener solo datos válidos ingresados y confirmados, sin participantes parcialmente agregados. '''