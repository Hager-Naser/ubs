Route::prefix('admin')->name('admin.')->group(function () {
            Route::prefix('dashboard')->name('dashboard')->group(function () {

                Route::get('/', [DashboardController::class, "index"]);
                //////////////////////departments////////////////////////////////////////
                Route::prefix('/sections')->name('.sections')->group(function () {

                    Route::get('/', [SectionController::class, "index"]);
                    Route::get('/add', [SectionController::class, "add"])->name('.add');
                    Route::post('/store', [SectionController::class, "store"])->name('.store');
                    Route::get('/edit/{id}', [SectionController::class, "find"])->name('.indexEdit');
                    Route::post('/edit/{id}', [SectionController::class, "update"])->name('.edit');
                    Route::delete("/delete/{id}", [SectionController::class, "delete"])->name(".delete");
                });
                Route::prefix("/doctors")->name(".doctors")->group(function(){
                    Route::get('/', [DoctorController::class, "index"]);
                });
            });
        });
