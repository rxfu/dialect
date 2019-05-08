<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="FuRongxin">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>广西粤方言有声数据库查询系统</title>

        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/audioplayer.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        </style>
    </head>
    <body>
        <div class="container-fluid px-0">
            <a href="{{ url('/') }}" class="logo-title">
                <div class="logo">
                    <h1 class="text-center">广西粤方言有声数据库查询系统</h1>
                </div>
            </a>
        </div>

        <div class="container">
            <header role="header" id="header" class="pt-3">
                <div class="row justify-content-center">
                    <div class="col-sm-12">
                        <form method="get" action="{{ url('/search') }}">
                            <div class="form-row">
                                <div class="col-sm-2">
                                    <select name="zone" class="form-control">
                                        <option value="all">== 全部方言点 ==</option>
                                        <option value="梧州白话">梧州白话</option>
                                        <option value="大安白话">大安白话</option>
                                        <option value="南宁白话">南宁白话</option>
                                        <option value="崇左白话">崇左白话</option>
                                        <option value="崇左肆排话">崇左肆排话</option>
                                        <option value="桂平白话">桂平白话</option>
                                        <option value="平果白话">平果白话</option>
                                        <option value="钦州白话">钦州白话</option>
                                        <option value="廉州白话">廉州白话</option>
                                        <option value="玉林白话">玉林白话</option>
                                        <option value="富川梧州话">富川梧州话</option>
                                        <option value="荔浦寨话">荔浦寨话</option>
                                        <option value="大埔百姓话">大埔百姓话</option>
                                        <option value="金鸡伢话">金鸡伢话</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select name="type" class="form-control">
                                        <option value="all">== 全部类型 ==</option>
                                        <option value="单字">单字</option>
                                        <option value="词汇">词汇</option>
                                        <option value="语法例句">语法例句</option>
                                        <option value="连读变调">连读变调</option>
                                        <option value="语篇">语篇</option>
                                    </select>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="q" placeholder="请输入关键词" class="form-control">
                                        <input type="submit" value="检索" class="btn btn-primary text-white">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </header>

            <main role="main" id="main" class="row justify-content-center">
                <div class="col-sm-12">
                    @if (is_null($items))
                        <blockquote class="intro p-4 mt-4">
                            <h4 class="text-center">广西粤方言有声数据库查询系统使用说明</h4>

                            <ol>
                                <li>
                                    本查询系统仅提供方言点和类型检索，方言点共14个，类型共4种。
                                </li>
                                <li>
                                    查询关键字为有声语料例字。
                                </li>
                                <li>
                                    查询系统为模糊查询，只要例字中包含查询关键字都能在结果中显示出来。若不输入关键字，则默认为对应方言点和类型的全部有声语料查询。
                                </li>
                                <li>
                                    查询结果为列表形式，可在线播放有声语料。
                                </li>
                                <li>
                                    建议使用Google Chrome浏览器进行操作。
                                </li>
                            </ol>
                        </blockquote>
                    @else
                        <div class="py-1">
                            <small class="text-muted">共检索到 {{ $items->total() }} 条符合条件的条目</small>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="white-space: no-wrap">编号</th>
                                    <th style="white-space: no-wrap">方言点</th>
                                    <th style="white-space: no-wrap">类型</th>
                                    <th style="white-space: no-wrap">关键词</th>
                                    <th style="white-space: no-wrap">有声语料</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->seq }}</td>
                                        <td>{{ $item->zone }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->keyword }}</td>
                                        <td>
											<audio preload="auto" controls>
												<source src="{{ asset('storage/' . $item->path) }}" type="audio/wav" />
											</audio>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <div class="row justify-content-center">
                                            {{ $items->appends($_GET)->links() }}
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    @endif
                </div>
            </main>

            <footer role="footer" id="footer" class="row justify-content-center">
                &copy; {{ date('Y') }}. 广西师范大学文学院.
            </footer>
        </div>
    </body>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/audioplayer.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
    	$(function() {
    		$('audio').audioPlayer();
    	})
    </script>
</html>
