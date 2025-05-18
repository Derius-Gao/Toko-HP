
<!-- filepath: app/Views/form_pembayaran.php -->
<div class="form-pembayaran-modal">
    <h2>Pembayaran</h2>
    <div class="info">
        <strong>Merk:</strong> <?= $hp['merk']; ?><br>
        <strong>Jumlah:</strong> <?= $keranjang['jumlah']; ?><br>
        <strong>Total Harga:</strong> Rp<?= number_format($total_harga, 0, ',', '.'); ?>
    </div>
    <form action="<?= base_url('Transaksi/prosesBayar/' . $keranjang['id_keranjang']); ?>" method="post" enctype="multipart/form-data">
        <label for="metode_pembayaran">Metode Pembayaran</label>
        <select name="metode_pembayaran" id="metode_pembayaran" required onchange="showRekeningInfo()">
            <option value="">-- Pilih Metode --</option>
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="E-Wallet">E-Wallet</option>
        </select>

        <div id="rekening-info" class="rekening-info"></div>

        <label for="bukti_pembayaran">Bukti Pembayaran</label>
        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*">

        <button type="submit">Bayar Sekarang</button>
    </form>
</div>
<style>
.form-pembayaran-modal {
    max-width: 500px;
    margin: 0 auto;
    background: #fff;
    padding: 24px;
    border-radius: 12px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.08);
}
.form-pembayaran-modal h2 {
    text-align: center;
}
.form-pembayaran-modal label {
    font-weight: bold;
    margin-top: 10px;
    display: block;
}
.form-pembayaran-modal input,
.form-pembayaran-modal select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 8px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
}
.form-pembayaran-modal button {
    margin-top: 20px;
    width: 100%;
    background: #27ae60;
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
}
.form-pembayaran-modal button:hover {
    background: #219150;
}
.form-pembayaran-modal .info {
    margin: 10px 0;
}
.form-pembayaran-modal .rekening-info {
    background: #f9f9f9;
    border-radius: 8px;
    padding: 10px;
    margin-top: 10px;
    display: none;
}
</style>