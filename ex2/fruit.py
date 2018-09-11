#/usr/bin/python3
# -*- coding: utf-8 -*-

inventaire = [
    ("pommes", 22),
    ("melons", 4),
    ("poires", 18),
    ("fraises", 76),
    ("prunes", 51),

]
print(inventaire)
inventaire_inverse = sorted([(quantite, fruit) for fruit,quantite in inventaire])
print(inventaire_inverse)
inventaire = [(fruit, quantite) for quantite, fruit in inventaire_inverse]
print(inventaire)

