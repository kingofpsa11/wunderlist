<div class="dialog-wrapper">
    <div id="settings" class="dialog preferences show">
        <div class="content">
            <div class="tabs">
                <ul>
                    <li>
                        <a rel="general">
                            <span class="icon settings-general"></span>
                            <span class="tab-label">
                                General
                            </span>
                        </a>
                    </li>
                    <li>
                        <a rel="account">
                            <span class="icon settings-account"></span>
                            <span class="tab-label">
                                Account
                            </span>
                        </a>
                    </li>
                    <li>
                        <a rel="shortcuts">
                            <span class="icon settings-shortcuts"></span>
                            <span class="tab-label">
                                Shortcuts
                            </span>
                        </a>
                    </li>
                    <li>
                        <a rel="smart_lists">
                            <span class="icon settings-smart-lists"></span>
                            <span class="tab-label">
                                Smart Lists
                            </span>
                        </a>
                    </li>
                    <li>
                        <a rel="notifications">
                            <span class="icon settings-notification"></span>
                            <span class="tab-label">
                                Notification
                            </span>
                        </a>
                    </li>
                    <li>
                        <a rel="about">
                            <span class="icon settings-about"></span>
                            <span class="tab-label">
                                About
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="settings-content-inner-wrapper">
                <div class="settings-content-inner-general">
                    <div class="separator">
                        <div class="cols">
                            <div class="col-60 text-right">Language</div>
                            <div class="col-40">
                                <span class="select">
                                    <select id="edit-language" class="tabStart">
                                        <option value="en" >English</option>
                                        <option value="po" >Portugues(Brazil)</option>                                                    
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="cols">
                            <div class="col-60 text-right">Date Format</div>
                            <div class="col-40">
                                <span class="select">
                                    <select id="edit-date-format" class="tabStart">
                                        <option value="DD.MM.YYYY" selected="">DD.MM.YYYY</option>
                                        <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                                        <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                                        <option value="YYYY/MM/DD">YYYY/MM/DD</option>
                                        <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="cols">
                            <div class="col-60 text-right">Date Format</div>
                            <div class="col-40">
                                <div>
                                    <input type="radio" name="edit-time-format" value="12 hour" id="edit-time-format-12">
                                    <label for="edit-time-format-12" style="font-size:13px;">12 Hours</label>
                                    <input type="radio" name="edit-time-format" value="24 hour" id="edit-time-format-24">
                                    <label for="edit-time-format-24" style="font-size:13px;">24 Hours</label>
                                </div>
                            </div>
                        </div>
                        <div class="cols">
                            <div class="col-60 text-right">Start of the Week</div>
                            <div class="col-40">
                                <span class="select">
                                    <select id="edit-start-of-week" class="tabStart">
                                        <option value="sat">Saturday</option>
                                        <option value="sun">Sunday</option>
                                        <option value="mon">Monday</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="separator">
                        <div class="cols">
                            <div class="col-60 text-right">Enable sound for checking-off a to-do</div>
                            <div class="col-40">
                                <div class="checkbox">
                                    <input type="checkbox" name="" id="">
                                </div>
                            </div>
                        </div>
                        <div class="cols">
                            <div class="col-60 text-right">Enable sound for checking-off a to-do</div>
                            <div class="col-40">
                                <div class="checkbox">
                                    <input type="checkbox" name="" id="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator">
                        <div class="cols">
                            <div class="col-60 text-right">Add To-dos</div>
                            <div class="col-40">
                                <span class="select">
                                    <select id="edit-new-task-location" class="tabStart">
                                        <option value="top">Top of List</option>
                                        <option value="bottom">Bottom of List</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="cols">
                            <div class="col-60 text-right">Confirm before deleting to-dos</div>
                            <div class="col-40">
                                <div class="checkbox">
                                    <input type="checkbox" name="" id="">
                                </div>
                            </div>
                        </div>
                        <div class="cols">
                            <div class="col-60 text-right">Star moves to-do to top</div>
                            <div class="col-40">
                                <div class="checkbox">
                                    <input type="checkbox" name="" id="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator">
                        <div class="cols">
                            <div class="col-60 text-right">Enable smart due dates</div>
                            <div class="col-40">
                                <div class="checkbox">
                                    <input type="checkbox" name="" id="">
                                </div>
                            </div>
                        </div>
                        <div class="cols">
                            <div class="col-60 text-right">Remove smart due date text in to-dos</div>
                            <div class="col-40">
                                <div class="checkbox">
                                    <input type="checkbox" name="" id="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator">
                        <div class="cols">
                            <div class="col-60 text-right">Print completed to-dos</div>
                            <div class="col-40">
                                <div class="checkbox">
                                    <input type="checkbox" name="" id="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator">
                        <div class="cols">
                            <div class="col-60 text-right">Show Subtask progress on to-dos</div>
                            <div class="col-40">
                                <div class="checkbox">
                                    <input type="checkbox" name="" id="">
                                </div>
                            </div>
                        </div>
                        <div class="cols">
                            <div class="col-60 text-right">Enable context menus</div>
                            <div class="col-40">
                                <div class="checkbox">
                                    <input type="checkbox" name="" id="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-footer">
            <div class="cols">
                <div class="col-40"></div>
                <div class="col-40"></div>
                <div class="col-20">
                    <button class="full blue close">
                        Done
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>