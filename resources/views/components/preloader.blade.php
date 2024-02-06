<style>
    #preloader {
    overflow-y: hidden;
    background: #343A40;
    position: fixed;
    inset: 0;
    z-index: 1100;
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
    animation: spin 1.5s linear infinite;
    }
    @keyframes spin {
        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div id="preloader">
    
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        if (document.querySelector('#preloader')) {
            window.addEventListener('load', () => {

            setTimeout(() => {
                document.querySelector('#preloader').remove();
            }, 500);
            
            });
        }
    });
</script>