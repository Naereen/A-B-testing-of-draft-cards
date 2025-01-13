#!/usr/bin/env python3
import sqlite3
import pandas as pd

# Connect to your SQLite database
conn = sqlite3.connect('../experiments.db')

cursor = conn.cursor()
# Execute a query to get the data
cursor.execute("SELECT * FROM experiments")

# Fetchall data
rows = cursor.fetchall()

# Convert to DataFrame
df = pd.DataFrame(rows, columns=[column[0] for column in cursor.description])

# Write dataframe to CSV
df.to_csv('../experiments.csv', index=False)
