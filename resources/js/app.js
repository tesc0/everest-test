require('./bootstrap');

(function() {

    let robot_select = document.querySelectorAll('.robot-select');
    for (let i = 0; i < robot_select.length; i++) {
        robot_select[i].addEventListener('change', function() {
            if (document.querySelectorAll('.robot-select:checked').length === 2) {                
                let not_checked_input = document.querySelectorAll('.robot-select:not(:checked)');
                for (let k = 0; k < not_checked_input.length; k++) {
                    not_checked_input[k].disabled = true;
                }

                document.querySelector('#start_fight').disabled = false;

            } else {
                let input = document.querySelectorAll('.robot-select');
                for (let k = 0; k < input.length; k++) {
                    input[k].disabled = false;
                }
            }
        });
    }

    if (document.querySelector('#start_fight') !== null) {
        document.querySelector('#start_fight').addEventListener('click', function() {

            let formdata = new FormData();
            formdata.append('_token', document.getElementById('_token').value);
            let checked_input = document.querySelectorAll('.robot-select:checked');
            for (let i = 0; i < checked_input.length; i++) {
                formdata.append('robots[]', checked_input[i].dataset.robot);
            }

            fetch('/fight', {
                method: 'POST',
                body: formdata
            }).then(response => response.json()).then(json => {

                let winner = json.winner;
                let loser = json.loser;

                document.querySelector('.robot-select[data-robot="' + winner.id + '"]').parentElement.parentElement.classList.add('table-success');
                document.querySelector('.robot-select[data-robot="' + loser.id + '"]').parentElement.parentElement.classList.add('table-danger');

                let winner_html = "<h5>Győztes adatai</h5>";
                winner_html += "<p>";
                winner_html += "Név: " + winner.name + "<br>";
                winner_html += "Típus: " + winner.type + "<br>";
                winner_html += "Erő: " + winner.power + "<br>";
                winner_html += "Létrehozva: " + winner.created_at + "<br>";
                winner_html += "</p>";

                document.querySelector('#winner_details').innerHTML = winner_html;

                setTimeout(() => {
                    document.querySelector('.robot-select[data-robot="' + winner.id + '"]').parentElement.parentElement.classList.remove('table-success');
                    document.querySelector('.robot-select[data-robot="' + loser.id + '"]').parentElement.parentElement.classList.remove('table-danger');
                }, 5000);

                let input = document.querySelectorAll('.robot-select');
                for (let k = 0; k < input.length; k++) {
                    input[k].checked = false;
                    input[k].disabled = false;
                }
            });
        });
    }
})();