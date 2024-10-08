<?php include("../_inc/head.php"); ?>

<body>
    <div id="wrap">
        <header id="header">
            <div class="header__inner">
                <button type="button" class="btn_back"></button>
            </div>
            <div class="header__title">注销账号</div>
        </header>
        <main class="main">
            <div class="mypage__container">
                <section class="withdrawal__wrap">
                    <div class="section__inner">
                        <p class="withdrawal__title"><em>注销前请确认</em></p>
                        <ul class="withdrawal__list">
                            <li><span class="dot">&middot;</span>注销时会员优惠将自动取消.<br>(积分、抵用券等)</li>
                            <li><span class="dot">&middot;</span>注销后不能享用服务或查询，不能用相同的ID账号重新注册. </li>
                            <li><span class="dot">&middot;</span>重新加入时不提供新会员优惠.</li>
                        </ul>
                        <div class="button__wrap">
                            <button type="button" class="btn btn-radius on btn-modal" data-modal="confirm">注销</button>
                        </div>
                    </div>
                </section>

                <!-- 모달 -->
                <div class="modal-layer" data-modal="confirm">
                    <div class="modal-layer__window">
                        <div class="modal-body">
                            <p class="modal__text">已完成注销.<br>感谢您使用该系统.</p>
                        </div>
                        <div class="button__wrap">
                            <a href="/login/login.php" class="btn btn-radius btn-close">确认</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
</body>
</html>