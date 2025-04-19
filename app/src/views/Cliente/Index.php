<section class="caixa">
	<div class="thead"><i class="ico lista"></i> Listagem</div>
	<div class="base-lista">

		<div>
			<div class="text-end d-flex">
				<a href="<?php echo BASE_URL . "cliente/create" ?>" class="btn d-inline-block mb-2 mx-1"><i class="fas fa fa-plus-circle" aria-hidden="true"></i> Cadastrar</a>
				<a href="" class="btn btn-roxo d-inline-block mb-2 filtro"><i class="fas fa fa-filter" aria-hidden="true"></i> Filtrar</a>
			</div>
		</div>
		<div class="lst mostraFiltro">
			<form action="" method="">
				<div class="rows">
					<div class="col-4">
						<select name="txt_id_empresa">
							<option selected>Selecione o valor...</option>
							<option value="1">Código</option>
							<option value="2">Nome</option>
							<option value="3">Email</option>
							<option value="4">Cidade</option>
							<option value="5">Site</option>
							<option value="6">Fone</option>
						</select>
					</div>
					<div class="col-6">
						<input type="text" name="" placeholder="Valor da pesquisar...">
					</div>
					<div class="col-2">
						<input type="submit" class="btn" value="pesquisar">
					</div>
				</div>
			</form>
		</div>
		<?php $this->includeMessage() ?>
		<div class="tabela-responsiva">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
				<thead>
					<tr>
						<th align="left">ID</th>
						<th align="left">Nome</th>
						<th align="left">Email</th>
						<th align="center">Telefone</th>
						<th align="center">Ação</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($clientes as $cliente) { ?>

						<tr>
							<td><?php echo $cliente->id_cliente ?></td>
							<td><?php echo $cliente->nome ?></td>
							<td><?php echo $cliente->email ?></td>
							<td align="center"><?php echo $cliente->celular ?></td>
							<td align="center">
								<a href=<?php echo BASE_URL . "cliente/update/" . $cliente->id_cliente ?> class="btn btn-verde">Editar</a>
								<a href=<?php echo BASE_URL . "cliente/delete/" . $cliente->id_cliente ?> class="btn btn-vermelho">Excluir</a>
							</td>
						</tr>


					<?php } ?>

				</tbody>

			</table>
		</div>
	</div>
</section>