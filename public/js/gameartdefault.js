document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("slotGamesContainer");
    if (!container) return;

    const playerId = container.dataset.playerId;
    const playerToken = container.dataset.playerToken;
    const currency = container.dataset.currency;
    let timer;

    function startTimer() {
        if (timer) clearInterval(timer);
        timer = setInterval(() => {
            startAjax("/component/weaver/?task=account.getPlayerBalance", '', getUpdatedBalance, 'nottoshow');
        }, 5000);
    }

    function getUpdatedBalance(result) {
        if (!validateSession(result)) return;
        const res = JSON.parse(result);
        if (res.errorCode === 0) {
            document.querySelector(".cash-balance").innerHTML = `${res.wallet.currency} ${res.wallet.totalBalance}`;
        }
    }

    function showIframe(url) {
        document.getElementById('slot_iframe').innerHTML = `
            <div class="gameIframeOuterWrap">
                <div class="trigger-btn">
                    <span class="maxi_btn"><img src="/images/fullScreen-icon.png"></span>
                    <span class="mini_btn"><img src="/images/restore-icon.png"></span>
                </div>
                <div id="iframe_ct"><iframe src="${url}"></iframe></div>
            </div>`;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function launchGame(type, gameId) {
        const action = type === 'demo' ? 'get_demo' : 'get_game';
        if (type === 'real' && !document.body.classList.contains('post-login')) {
            $('#home_login').modal('show');
            return;
        }

        const params = `action=${action}&game_id=${gameId}`;
        startAjax("/component/weaver/?task=account.gamelaunchUrl", params, function (result) {
            const res = JSON.parse(result);
            if (res.status === 200 && res.response?.game_url) {
                showIframe(res.response.game_url);
                if (type === 'real') startTimer();
            } else {
                alert(res.response || "Error launching game");
            }
        }, "null");
    }

    document.querySelectorAll('.demo-btn').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            launchGame('demo', btn.dataset.gameId);
        });
    });

    document.querySelectorAll('.game-launch').forEach(img => {
        img.addEventListener('click', e => {
            e.preventDefault();
            launchGame('real', img.closest('.cellInnerWrap').dataset.gameId);
        });
    });

    // Fullscreen toggling
    document.addEventListener("click", function (e) {
        if (e.target.closest(".maxi_btn")) {
            document.body.classList.add("slotfullscreen");
            const elem = document.getElementById("slot_iframe");
            if (elem.requestFullscreen) elem.requestFullscreen();
            else if (elem.webkitRequestFullscreen) elem.webkitRequestFullscreen();
            else if (elem.msRequestFullscreen) elem.msRequestFullscreen();
        }

        if (e.target.closest(".mini_btn")) {
            document.body.classList.remove("slotfullscreen");
            if (document.exitFullscreen) document.exitFullscreen();
            else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
            else if (document.msExitFullscreen) document.msExitFullscreen();
        }
    });

    document.addEventListener('fullscreenchange', exitHandler);
    document.addEventListener('webkitfullscreenchange', exitHandler);
    document.addEventListener('mozfullscreenchange', exitHandler);
    document.addEventListener('MSFullscreenChange', exitHandler);

    function exitHandler() {
        if (!document.fullscreenElement &&
            !document.webkitIsFullScreen &&
            !document.mozFullScreen &&
            !document.msFullscreenElement) {
            document.body.classList.remove("slotfullscreen");
        }
    }
});
