<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class EmployeeController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Employee);

        $grid->id('Id')->sortable();
        $grid->company('Company')->name();
        $grid->first_name('First name');
        $grid->last_name('Last name');
        $grid->email('Email');
        $grid->phone('Phone');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Employee::findOrFail($id));
        $show->id('Id');
        $show->company('Company')->as(function ($company) {
            return $company->name;
        });
        $show->first_name('First name');
        $show->last_name('Last name');
        $show->email('Email');
        $show->phone('Phone');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Employee);
        $companies = new Company();

        $form->display('id','ID');
        $form->select('company_id',"Company")->
            options(Company::all()->pluck('name','id'))->required();
        $form->text('first_name', 'First name')->required();
        $form->text('last_name', 'Last name')->required();
        $form->email('email', 'Email');
        $form->mobile('phone', 'Phone');

        return $form;
    }
}
