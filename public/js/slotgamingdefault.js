document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("slotGamesContainer");
    if (!container) return;

    const playerToken = container.dataset.playerToken;
    const playerId = container.dataset.playerId;
    const currency = container.dataset.currency;
   
    let num = Math.floor(Math.random() * 500) + 1;
    let timer;

    // Game launch logic
    function gameLaunch(gameId) {
        console.log(playerToken);
        console.log(gameId);
        console.log(playerId);
        console.log(currency);
        if (!document.body.classList.contains("post-login")) {
            console.log(document.body.classList);
            console.log('loginmodal');
            const loginModal = new bootstrap.Modal(document.getElementById('home_login'));
            loginModal.show();
        } else {
            if (currency !== "EUR") {
                const errorPopup = document.getElementById('error_popup');
                errorPopup.querySelector('.msg').innerHTML = "Your currency does not support these games. You can play demo games only.";
                const modal = new bootstrap.Modal(errorPopup);
                modal.show();
                return;
            }

            num++;
            const dateobj = new Date();
            const ICASINO_TOKEN = playerToken + ":" + num;
            const REAL_MONEY_SESSION = 1;
            const LAUNCHED_AT_UTC = dateobj.toISOString();

            const message = `${ICASINO_TOKEN}-${playerId}-${currency}-${REAL_MONEY_SESSION}-${LAUNCHED_AT_UTC}`;
            const secretKey = "z1NUiezDOaG9GOFVRL0ulDZALLId12";
            const hmacSha1 = CryptoJS.HmacSHA1(message, secretKey);
            const checksumEncode = encodeURIComponent(CryptoJS.enc.Base64.stringify(hmacSha1));

            const url = `https://rgs-stage.ctrgs.com/web-launch/base/jiMG1TIP4PJqKJ7D0Xzq?game_id=${gameId}` +
                `&ic=base/jiMG1TIP4PJqKJ7D0Xzq&checksum=${checksumEncode}&icasino_token=${ICASINO_TOKEN}` +
                `&icasino_account_id=${playerId}&icasino_account_currency=${currency}&real_money_session=${REAL_MONEY_SESSION}` +
                `&launched_at_utc=${LAUNCHED_AT_UTC}&version=5`;

            document.getElementById('slot_iframe').innerHTML = `
                <div class="gameIframeOuterWrap">
                    <div class="trigger-btn">
                        <span class="maxi_btn"><img src="/images/fullScreen-icon.png"></span>
                        <span class="mini_btn"><img src="/images/restore-icon.png"></span>
                    </div>
                    <div id="iframe_ct"><iframe src="${url}"></iframe></div>
                </div>
            `;

            window.scrollTo({ top: 0, behavior: 'smooth' });
            startTimer();
        }
    }

    function startTimer() {
        if (timer) clearInterval(timer);
        timer = setInterval(function () {
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

    document.querySelectorAll('.game-launch').forEach(img => {
        img.addEventListener('click', function () {
            const gameId = this.dataset.gameId;
            gameLaunch(gameId);
        });
    });

    // Attach demo button click
    document.querySelectorAll(".demo-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            console.log("deepak");
            const gameId = this.dataset.gameId;
            console.log(gameId);
            const ICASINO_TOKEN = Math.floor(Math.random() * 100000);
            const LAUNCHED_AT_UTC = new Date().toISOString();

            const message = `${ICASINO_TOKEN}-${LAUNCHED_AT_UTC}`;
            console.log(message);
            const secretKey = "z1NUiezDOaG9GOFVRL0ulDZALLId12";
            const hmacSha1 = CryptoJS.HmacSHA1(message, secretKey);
            const checksumEncode = encodeURIComponent(CryptoJS.enc.Base64.stringify(hmacSha1));
             
            const url = `https://rgs-stage.ctrgs.com/web-launch/base/jiMG1TIP4PJqKJ7D0Xzq?game_id=${gameId}` +
                `&ic=base/jiMG1TIP4PJqKJ7D0Xzq&checksum=${checksumEncode}&icasino_token=${ICASINO_TOKEN}` +
                `&real_money_session=0&launched_at_utc=${LAUNCHED_AT_UTC}&version=5`;

            document.getElementById('slot_iframe').innerHTML = `
                <div class="gameIframeOuterWrap">
                    <div class="trigger-btn">
                        <span class="maxi_btn"><img src="/images/fullScreen-icon.png"></span>
                        <span class="mini_btn"><img src="/images/restore-icon.png"></span>
                    </div>
                    <div id="iframe_ct"><iframe src="${url}"></iframe></div>
                </div>
            `;

            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

    // Fullscreen toggles
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
        if (!document.fullscreenElement && !document.webkitIsFullScreen &&
            !document.mozFullScreen && !document.msFullscreenElement) {
            document.body.classList.remove("slotfullscreen");
        }
    }

    // Attach gameLaunch on image click
    document.querySelectorAll(".game-launch").forEach(img => {
        img.addEventListener("click", function () {
            const gameId = this.dataset.gameId;
            gameLaunch(gameId);
        });
    });
});
