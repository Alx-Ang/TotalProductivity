 const container = document.querySelector(".container"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      login = document.querySelector(".register-link"),
      registerUser = document.querySelector(".login-link");

    // código js para mostrar/ocultar la contraseña y cambiar el icono
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    })
                }else{
                    pwField.type = "password";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    })
                }
            }) 
        })
    })

// Código js para que aparezca el formulario de login y reseteo de contraseña
    login.addEventListener("click", ( )=>{
        container.classList.add("active");
    });
    registerUser.addEventListener("click", ( )=>{
        container.classList.remove("active");
    });