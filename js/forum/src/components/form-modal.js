import Component from 'flarum/component';
import LoadingIndicator from 'flarum/components/loading-indicator';
import Alert from 'flarum/components/alert';
import icon from 'flarum/helpers/icon';

export default class FormModal extends Component {
  constructor(props) {
    super(props);

    this.alert = null;
    this.loading = m.prop(false);
  }

  view(options) {
    if (this.alert) {
      this.alert.props.dismissible = false;
    }

    return m('div.modal-dialog', {className: options.className, config: this.element}, [
      m('div.modal-content', [
        m('a[href=javascript:;].btn.btn-icon.btn-link.close.back-control', {onclick: this.hide.bind(this)}, icon('times')),
        m('form', {onsubmit: this.onsubmit.bind(this)}, [
          m('div.modal-header', m('h3.title-control', options.title)),
          this.alert ? m('div.modal-alert', this.alert.view()) : '',
          m('div.modal-body', [
            m('div.form-centered', options.body)
          ]),
          options.footer ? m('div.modal-footer', options.footer) : ''
        ])
      ]),
      LoadingIndicator.component({className: 'modal-loading'+(this.loading() ? ' active' : '')})
    ])
  }

  ready() {
    this.$(':input:first').select();
  }

  hide() {
    app.modal.close();
  }
}
