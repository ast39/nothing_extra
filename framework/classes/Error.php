<?php

namespace framework\classes;


class Error {

    protected static function headers()
    {
        ob_start();?>
            <head>
                <style>
                    .code_block {
                        padding: 8px 16px;
                        background-color: #fff;
                        border: 0.5px solid #ddd;
                        box-shadow: inset 47px 0 0 #fbfbfc, inset 48px 0 0 #ececf0;
                        font-family: "Consolas","Bitstream Vera Sans Mono","Courier New",Courier,monospace!important;
                        color: #333;
                        font-size: 13px;
                        display: block;
                    }
                    .code_block ol {
                        margin: 0 0 0 -8px;
                    }
                    .code_block ol li {
                        padding-left: 12px;
                        color: #afafaf;
                        line-height: 1.8em;
                        list-style: decimal;
                    }
                    .code_block ol li .line_code {
                        color: #212529 !important;
                    }
                    .code_block .comment {
                        font-style: italic;
                        color: #afafaf;
                    }
                    .code_block .keywords {
                        font-weight: bold;
                        color: #069;
                    }
                    .code_block .class {
                        color: #008200;
                    }
                    .code_block .method {
                        color: #ff1493;
                    }
                    .code_block .variable {
                        color: #a70;
                    }
                    .code_block .data {
                        color: blue;
                    }
                    .code_block li.tab1 {
                        padding-left: 3em !important;
                    }
                    .code_block li.tab2 {
                        padding-left: 6em !important;
                    }
                    .code_block li.tab3 {
                        padding-left: 9em !important;
                    }
                    .code_block li.tab4 {
                        padding-left: 12em !important;
                    }
                    .code_title {
                        padding: 8px 16px 8px 62px;
                        background-color: #fff;
                        border: 0.5px solid #ddd;
                        box-shadow: inset 47px 0 0 #fbfbfc, inset 48px 0 0 #ececf0;
                        font-family: "Consolas","Bitstream Vera Sans Mono","Courier New",Courier,monospace!important;
                        color: #555;
                        font-size: 16px;
                        font-weight: bolder;
                        display: block;
                        margin-bottom: 8px;
                    }
                    .code_msg {
                        padding: 8px 16px 8px 62px;
                        background-color: #fff;
                        border: 0.5px solid #ddd;
                        box-shadow: inset 47px 0 0 #fbfbfc, inset 48px 0 0 #ececf0;
                        font-family: "Consolas","Bitstream Vera Sans Mono","Courier New",Courier,monospace!important;
                        color: #008200;
                        font-size: 14px;
                        font-weight: bolder;
                        display: block;
                        margin-bottom: 8px;
                    }
                </style>
            </head>
        <?= ob_get_clean();
    }

    public static function view(array $error)
    {
        self::headers();

        ob_start();?>
            <body>
                <div class="code_title">NothingExtra : Exception Error</div>
                <div class="code_msg">Error: <?= $error['msg'] ?></div>
                <div class="code_block">
                    <ol>
                        <?php foreach ($error as $key => $value): ?>
                            <?php self::errorLine($key, $value, 0); ?>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </body>
        <?= ob_get_clean();
    }

    protected static function errorLine($key, $value, $tab)
    {
        ob_start();?>
            <?php if (is_array($value)): ?>
                <li <?= $tab > 0 ? 'class="tab'. $tab . '"': '' ?>>
                    <span class="line_code">
                        <span class="keywords"><?= $key ?></span> :
                    </span>
                </li>
                <?php foreach ($value as $k => $v): ?>
                    <?php self::errorLine($k, $v, $tab + 1); ?>
                <?php endforeach; ?>
            <?php else: ?>
                <li <?= $tab > 0 ? 'class="tab'. $tab . '"': '' ?>>
                    <span class="line_code">
                        <span class="keywords"><?= $key ?></span> : <span class="data"><?= $value ?></span>
                    </span>
                </li>
            <?php endif; ?>
        <?= ob_get_clean();
    }
}
