#!/usr/bin/env python3
import sqlite3
import pandas as pd

# Connect to your SQLite database
conn = sqlite3.connect('../experiments.db')

cursor = conn.cursor()
# Execute a query to get the data
cursor.execute("SELECT COUNT(*) as nombresVotes, path FROM experiments GROUP BY path ORDER BY nombresVotes DESC")

# Fetchall data
rows = cursor.fetchall()

# Convert to DataFrame
df = pd.DataFrame(rows, columns=[column[0] for column in cursor.description])

# Write dataframe to CSV
df.to_csv('../statsOnVotes.csv', index=False)
