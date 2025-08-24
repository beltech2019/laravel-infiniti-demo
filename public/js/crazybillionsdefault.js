document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("slotGamesContainer");
    if (!container) return;
    const playerId = container.dataset.playerId;
    const playerToken = container.dataset.playerToken;
    const currency = container.dataset.currency;
    let timer;

    function gameLaunch(gameId) {
        if (!document.body.classList.contains("post-login")) {
            document.getElementById('loginModal').style.display = 'flex';
            return;
        }

        // if (currency !== "EUR") {
        //     $('#error_popup').find('.msg').html("Your currency does not support these games. You can play demo games only.");
        //     $('#error_popup').modal("show");
        //     return;
        // }

        const url = `https://prod1.cbcontents.com/marlipin/launch/cb.jsp?sessionID=${playerToken}&funReal=1&siteID=36&brandID=1&fixedID=${playerId}&lang=en&gameID=${gameId}&jurisdiction=malta&noWrapper=true`;

        $('#slot_iframe').html(`
            <div class="gameIframeOuterWrap">
                <div class="trigger-btn">
                    <span class="maxi_btn"><img src="/images/fullScreen-icon.png"></span>
                    <span class="mini_btn"><img src="/images/restore-icon.png"></span>
                </div>
                <div id="iframe_ct"><iframe src="${url}"></iframe></div>
            </div>
        `);
        $('html, body').animate({ scrollTop: 0 }, 'slow');
        startTimer();
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
            $(".cash-balance").html(`${res.wallet.currency} ${res.wallet.totalBalance}`);
        }
    }

    document.querySelectorAll(".game-launch").forEach(img => {
        img.addEventListener("click", function () {
            const gameId = this.dataset.gameId;
            gameLaunch(gameId);
        });
    });

    document.querySelectorAll(".demo-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const gameId = this.dataset.gameId;
            const url = `https://prod1.cbcontents.com/marlipin/launch/cb.jsp?sessionID=sessionID&funReal=-1&siteID=36&brandID=1&lang=en&gameID=${gameId}&jurisdiction=malta&noWrapper=true`;

            $('#slot_iframe').html(`
                <div class="gameIframeOuterWrap">
                    <div class="trigger-btn">
                        <span class="maxi_btn"><img src="/images/fullScreen-icon.png"></span>
                        <span class="mini_btn"><img src="/images/restore-icon.png"></span>
                    </div>
                    <div id="iframe_ct"><iframe src="${url}"></iframe></div>
                </div>
            `);
            $('html, body').animate({ scrollTop: 0 }, 'slow');
        });
    });

    // Fullscreen toggle
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
});
