                   
                            <div>
                                <div class="heading">
                                    <span style="padding: 10px 15px;
                                    background: #f5f8f9;
                                    font-size: 20px;
                                    font-weight: 700;">شاشة أخبارنا</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
                                    viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
                                    <rect y="25" width="10" height="25" fill="#2E4866" />
                                    <rect width="10" height="25" fill="#C2111E" />
                                </svg>
                                </div>
                                <!-- horizantal line -->
                                <hr class="red-line">
                                <div>
                                    <div class="row">
                                        @foreach($newsL1 as $article)
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-3 mt-3">
                                            @if($article->image)
                                            <a href="{{Common::article_link($article)}}">      
                                                <div class="video-box">
                                                    <div class="icon mb-3 mt-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                                            viewBox="0 0 36 36" fill="none">
                                                            <circle cx="18.4258" cy="18.2212" r="16.5" stroke="white"
                                                                stroke-width="2" />
                                                            <path
                                                                d="M27 18.5C27.0005 18.6698 26.9451 18.8367 26.8392 18.9847C26.7332 19.1326 26.5804 19.2565 26.3954 19.3443L14.9345 24.8528C14.7413 24.9458 14.52 24.9965 14.2935 24.9998C14.0669 25.0031 13.8434 24.9588 13.6459 24.8716C13.4503 24.7856 13.2874 24.6603 13.1739 24.5085C13.0603 24.3567 13.0003 24.1839 13 24.0079V12.9921C13.0003 12.8161 13.0603 12.6433 13.1739 12.4915C13.2874 12.3397 13.4503 12.2144 13.6459 12.1284C13.8434 12.0412 14.0669 11.9969 14.2935 12.0002C14.52 12.0035 14.7413 12.0542 14.9345 12.1472L26.3954 17.6557C26.5804 17.7435 26.7332 17.8674 26.8392 18.0153C26.9451 18.1633 27.0005 18.3302 27 18.5Z"
                                                                fill="white" />
                                                        </svg>
                                                    </div>
                                                   
                                                    <p>{{$article->title}}</p>
                                                </div>
                                            </a>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        
                    
