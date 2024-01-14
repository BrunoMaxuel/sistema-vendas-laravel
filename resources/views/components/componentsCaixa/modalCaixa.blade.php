<div class="modal fade" id="modalCaixa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div id="modalHeader" class="modal-header">
				<h4 class="modal-title" id="title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div id="modalBody"class="modal-body">
				<form id="formCaixa" method="POST">
					@csrf
					<input type="hidden" id="addOrSangria" name="addOrSangria">
					<div class="form-group">
						<label id="text-label" for="valor"></label>
						<input name="valor_inicial" id="valor" class="form-control" placeholder="Informe o valor" data-mask="000.000,00" data-mask-reverse="true" required>
					</div>
					<div class="form-group">
						<label for="descricao">Informe uma descrição:</label>
						<input name="descricao" id="descricao" class="form-control" placeholder="Insira uma descrição (Opcional)" maxlength="50" >
					</div>
					<div class="modal-footer">
						<button type="submit" id="btnAction"class="btn btn-success" >Salvar alterações</button>
						<button type="button" id="btnModal"class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
