<!-- Modal login-->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary-to-secondary p-4">
                <h5 class="modal-title font-alt text-white" id="feedbackModalLabel">Entre na sua conta</h5>
                <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-0 p-5">
                <form id="contactForm" method="POST" action="{{route('login.auth')}}">
                    @csrf
                    <div class="mb-3">
                        <div>Email</div>
                        <input class="form-control" id="email" type="email" name="email" placeholder="Seu email..." required/>
                    </div>
                    <div class="mb-4">
                        <div>Senha</div>
                        <input class="form-control" id="name" name="password" type="password" placeholder="Sua senha..." required/>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>