	<ul>
								<li class="active">
									<a href="#0">Home</a>
									<ul>
										<li><a href="<?= base_url('/home/dashboard')?>" class="active">Dashboard</a></li>
									</ul>
								</li>
								<li>
									<a href="#0">Halaman</a>
									<ul>
                                        <?php
                                            if (session()->get('level')=='superadmin'){
          ?>
                                        <li><a href="<?= base_url('/Pengaturan/pengaturan')?>">Pengaturan</a></li>
<?php } ?>
                                        <li><a href="<?= base_url('/Keranjang/keranjang')?>">Keranjang</a></li>
                                        <li><a href="<?= base_url('/Hp/menuHp')?>">List HP</a></li>
										<li><a href="<?= base_url('/Transaksi/riwayat')?>">Riwayat Transaksi</a></li>
									</ul>
								</li>
								<li>
									<a href="#">User</a>
									<ul>
										<li><a href="<?= base_url('/Home/logout')?>">Logout</a></li>
										<li><a href="<?= base_url('/User/logActivitytab')?>">Activity Log</a></li>
										 <?php
                                            if (session()->get('level')=='admin' || session()->get('level')=='superadmin'){ ?>
										<li><a href="<?= base_url('/User/usr')?>">Tabel User</a></li>
									<?php } ?>
									</ul>
								</li>
									<li>
									<a href="<?=base_url('home/error')?>">Error 404</a>
								</li>
							</ul>
							</div>
					</div>
				</nav>
			</div>
		</div>
    </header>