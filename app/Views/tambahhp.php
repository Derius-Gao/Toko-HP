
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah HP</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f2f6;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input, textarea, select, button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        button {
            background-color: #27ae60;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #219150;
        }
    </style>
    <script>
        function formatRupiah(element) {
            let value = element.value.replace(/\D/g, ''); // Remove non-numeric characters
            value = new Intl.NumberFormat('id-ID').format(value);
            element.value = value;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Tambah HP</h1>
        <form action="<?= base_url('/Hp/simpanHp'); ?>" method="post" enctype="multipart/form-data">
            <label for="merk">Merk</label>
            <input type="text" id="merk" name="merk" required>

            <label for="tahun">Tahun</label>
            <input type="date" id="tahun" name="tahun" required>

            <label for="kondisi">Kondisi</label>
            <select id="kondisi" name="kondisi" required>
                <option value="baru">Baru</option>
                <option value="bekas">Bekas</option>
            </select>

            <label for="harga">Harga</label>
            <input type="text" id="harga" name="harga" oninput="formatRupiah(this)" required>
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>

            <label for="foto_hp">Foto HP</label>
            <input type="file" id="foto_hp" name="foto_hp" accept="image/*" required>

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>