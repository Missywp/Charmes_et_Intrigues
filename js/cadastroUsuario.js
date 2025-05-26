var togglePassView = false;
                document.getElementById("viewpass").addEventListener("click", function () {
                    togglePassView = !togglePassView;
                    var tipoatt = togglePassView ? "text" : "password";
                    document.getElementById("passinput").setAttribute("type", tipoatt);
                });

                var toggleConfirmPassView = false;
                document.getElementById("viewconfirmpass").addEventListener("click", function () {
                    toggleConfirmPassView = !toggleConfirmPassView;
                    var tipoatt = toggleConfirmPassView ? "text" : "password";
                    document.getElementById("confirmpass").setAttribute("type", tipoatt);
                });