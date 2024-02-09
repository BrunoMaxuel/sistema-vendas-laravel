@push('preloader_css')
    <style>
        #preloader {
        background: #343A40;
        position: fixed;
        inset: 0;
        z-index: 9100;
        }

        #preloader:before {
        content: "";
        width: 150px;
        height: 150px;
        position: fixed;
        top: calc(50% - 70px);
        left: calc(50% - 70px);
        border: 40px solid;
        border-radius: 50%;
        border-color: #00A2E8 transparent;
        animation: spin 1.4s linear infinite;
        }
        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
<div id="preloader">
    
</div>
@push('preloader_js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.body.style.overflow = 'hidden';

            if (document.querySelector('#preloader')) {
                window.addEventListener('load', () => {
                    
                setTimeout(() => {
                    document.querySelector('#preloader').remove();
                }, 200);
                });
            }
        });
    </script>
@endpush